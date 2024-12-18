<?php 
    class Admin extends Controller{
        function getShow(): void
        {
            $this->view("Manager_View", ["page" => "Admin"]);
        }
    }

