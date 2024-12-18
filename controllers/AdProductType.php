<?php
session_start();
class AdProductType extends Controller{
    function getShow(){
        $obj=$this->model("AdProductTypeModel");
        $data=$obj->getAdProductType();
        //$this->view("AdProductTypeView",$data);  
        // $this->view("Manager_View",["page"=>"AdProductTypeView","productType"=>$data]);
        // $this->view("backend/AdProductTypeView",["productType"=>$data]);
        $this->view("AdminView", [
            "page" => "backend/AdProductTypeView",
            "productType" => $data,
        ]);
    }


    public function delete($ma_loaisp){
        $obj=$this->model("AdProductTypeModel");
        $obj->deleteAdProductType($ma_loaisp);
        header("Location:..");
        exit();
    }
    public function insert(){
        $obj=$this->model("AdProductTypeModel");
        // $productTypeList = $obj->getAdProductType();
        $ma_loaisp =isset($_POST["txt_maloaisp"])?$_POST["txt_maloaisp"]:"";
        $ten_loaisp =isset($_POST["txt_tenloaisp"])?$_POST["txt_tenloaisp"]:"";
        $mota_loaisp =isset($_POST["txt_motaloaisp"])?$_POST["txt_motaloaisp"]:"";
        $obj->insertAdProductType($ma_loaisp, $ten_loaisp, $mota_loaisp);
        // header("Location: ./AdProductType");
        //
        $this->view("AdminView",["page"=>"backend/AdProductTypeView"]);
        exit();
    }
    public function update($ma_loaisp){
        $obj=$this->model("AdProductTypeModel");
        $productTypeList=$obj->getAdProductTypeID($ma_loaisp);
        $ten_loaisp=isset($_POST["txt_tenloaisp"])?$_POST["txt_tenloaisp"]:$productTypeList["ten_loaisp"];
        $mota_loaisp=isset($_POST["txt_motaloaisp"])?$_POST["txt_motaloaisp"]:$productTypeList["mota_loaisp"];
        //var_dump($productTypeList);
        $this->view("AdminView",["page"=>"backend/AdProductTypeView_Update","productType"=>$productTypeList]);
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $obj->updateAdProductType($ma_loaisp,$ten_loaisp,$mota_loaisp);
            header("Location:..");
            exit();
        }
    }

}