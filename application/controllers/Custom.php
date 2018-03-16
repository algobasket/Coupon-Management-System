<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Custom extends CI_Controller{

   protected $upsAccessKey = "";
   protected $upsUser = "";
   protected $upsPass = "";
   protected $stripeKey    = "";
   protected $paypalApiKey = "";

   function __construct(){
      parent::__construct();
      $this->load->helper('form');
      $this->load->helper('url');
      $this->load->library('session');
      $this->load->model('custom_model');
   }

   function index(){
     $this->allCoupon(1);
   }

   function createCoupon(){
     if($this->input->post('createCoupon')){
        $this->custom_model->createCoupon(array(
          'couponName' => $this->input->post('couponName'),
          'couponCode' => $this->input->post('couponCode'),
          'couponType' => $this->input->post('couponType'),
          'couponStartDate' => $this->input->post('couponStartDate'),
          'couponExpiryDate' => $this->input->post('couponExpiryDate'),
          'couponAmount' => $this->input->post('couponAmount'),
          'couponStatus' => 'available'
        ));
        $this->session->set_flashdata('alert','<div class="alert alert-primary" role="alert">Coupon Created successfully</div>');
        redirect('custom/allCoupon');
     }
     $data['isCreateCoupon'] = true;
     $this->load->view('customView',$data);
   }

    function updateCoupon(){
      if($this->input->post('updateCoupon')){
         $this->custom_model->updateCoupon($this->uri->segment(3),array(
           'couponName' => $this->input->post('couponName'),
           'couponCode' => $this->input->post('couponCode'),
           'couponType' => $this->input->post('couponType'),
           'couponStartDate' => $this->input->post('couponStartDate'),
           'couponExpiryDate' => $this->input->post('couponExpiryDate'),
           'couponAmount' => $this->input->post('couponAmount'),
           'couponStatus' =>  $this->input->post('couponStatus')
         ));
         $this->session->set_flashdata('alert','<div class="alert alert-primary" role="alert">Coupon Updated successfully</div>');
         redirect('custom/coupons');
      }
      $data['singleCoupon'] = $this->custom_model->singleCoupon($this->uri->segment(3));
      $data['isUpdateCoupon'] = true;
      $this->load->view('customView',$data);
    }

    function singleCoupon(){
      $data['allCoupon'] = $this->custom_model->singleCoupon($this->uri->segment(3));
      $data['isSingleCoupon'] = true;
      $this->load->view('customView',$data);
    }

    function allCoupon(){
    	$status = $this->uri->segment(3) ? $this->uri->segment(3) : 'available';
      $data['allCoupon'] = $this->custom_model->allCoupon($status);
      $data['isAllCoupon'] = true;
      $this->load->view('customView',$data);
    }

    function deleteCoupon($action){
      $this->custom_model->deleteCoupon($this->uri->segment(3));
      $this->session->set_flashdata('alert','<div class="alert alert-danger" role="alert">Coupon Deleted successfully</div>');
      redirect('custom/allCoupon');
    }

    function shippingPage(){
      $data['isShippingPage'] = true;
      $this->load->view('customView',$data);
    }


    function shippingRates(){
      require APPPATH.'libraries/vendor/autoload.php';

      $accessKey = 'CD407438BC5A4C38';  
      $userId    = 'ournameshop';
      $password  = 'H0llyw00d!';

      $rate = new Ups\Rate(
               $accessKey,
               $userId,
               $password
              );

    try {
         $shipment = new \Ups\Entity\Shipment();

         $shipperAddress = $shipment->getShipper()->getAddress();
         $shipperAddress->setPostalCode('27006');

         $address = new \Ups\Entity\Address();
         $address->setPostalCode('27006');
         $shipFrom = new \Ups\Entity\ShipFrom();
         $shipFrom->setAddress($address);

         $shipment->setShipFrom($shipFrom);

         $shipTo = $shipment->getShipTo();
         $shipTo->setCompanyName('UnReal Tournament');
         $shipToAddress = $shipTo->getAddress();
         $shipToAddress->setPostalCode('27006');

         $package = new \Ups\Entity\Package();
         $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_PACKAGE);
         $package->getPackageWeight()->setWeight(10);

         // if you need this (depends of the shipper country)
         $weightUnit = new \Ups\Entity\UnitOfMeasurement;
         $weightUnit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_LBS);
         $package->getPackageWeight()->setUnitOfMeasurement($weightUnit);

         $dimensions = new \Ups\Entity\Dimensions();
         $dimensions->setHeight(10);
         $dimensions->setWidth(10);
         $dimensions->setLength(10);

         $unit = new \Ups\Entity\UnitOfMeasurement;
         $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_CM);

         $dimensions->setUnitOfMeasurement($unit);
         $package->setDimensions($dimensions);

         $shipment->addPackage($package);

         var_dump($rate->getRate($shipment));
      } catch (Exception $e) {
         var_dump($e);
      }

    }

    function paypal(){

    }

    function paypalCallBack(){

    }

    function stripe(){

    }

    function stripeCallBack(){

    }


 }
?>
