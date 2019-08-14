<?php
class Imedia_Ajaxnewsletter_IndexController extends Mage_Core_Controller_Front_Action{
    public function IndexAction() {
      
	    $this->loadLayout();	  
        $this->renderLayout(); 
	  
    }
    public function newAction()
    {
		if ($_REQUEST['email']) {
            $session            = Mage::getSingleton('core/session');
            $customerSession    = Mage::getSingleton('customer/session');
            $email              = $_REQUEST['email'];
			$fname              = $_REQUEST['first_name'];
			$lname              = $_REQUEST['last_name'];
			$gender             = $_REQUEST['gender'];
			$type               = $_REQUEST['customer_type'];	
						
			try {
                if (!Zend_Validate::is($email, 'EmailAddress')) {
                    
                    echo "Please enter a valid email address.";
                    return;
                }

                if (Mage::getStoreConfig(Mage_Newsletter_Model_Subscriber::XML_PATH_ALLOW_GUEST_SUBSCRIBE_FLAG) != 1 && 
                    !$customerSession->isLoggedIn()) {
                    echo 'Sorry, but administrator denied subscription for guests. Please <a href="%s">register</a>.', Mage::helper('customer')->getRegisterUrl();
                    return;
				}

                $ownerId = Mage::getModel('newsletter/subscriber')
                        ->setWebsiteId(Mage::app()->getStore()->getWebsiteId())
                        ->loadByEmail($email)
                        ->getId();
                if ($ownerId !== null && $ownerId != $customerSession->getId()) {
                    echo 'This email address is already assigned to another user.';
                    return;
                }

                $status = Mage::getModel('newsletter/subscriber')->subscribe($email);
                /********* custom field   ***********/
				
				$subscriber = Mage::getModel('newsletter/subscriber')->loadByEmail($email);
				
				if ($fname){
				    $subscriber->setFirstName($fname);
				}
				if ($lname){
				    $subscriber->setLastName($lname);
				}
				if ($gender){
				    $subscriber->setGender($gender);
				}
				if ($type){
				    $subscriber->setCustomerType($type);
				}
				$subscriber->save();
				/********* custom field   ***********/
				
				if ($status == Mage_Newsletter_Model_Subscriber::STATUS_NOT_ACTIVE) {
                   echo "Confirmation request has been sent&&1";
				   return;
                }else{
                   echo "Thank you for your subscription&&1";
				   return;
                }
            }
            catch (Mage_Core_Exception $e) {
                echo "There was a problem with the subscription:".$e;
                return;
            }
            catch (Exception $e) {
                 echo "There was a problem with the subscription".$e;
                 return;
            }
        }
        $this->_redirectReferer();
    }
}