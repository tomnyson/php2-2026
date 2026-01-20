
<?php
class danhmuccontroller extends Controller
{
    public function index()
    {
        $danhmuc = $this->model('danhmuc'); //
        // $product = new Product();
        $data = $danhmuc->all();
        $title = "trang chu";
        // danhmuc.index
        $this->view("danhmuc/index", [
            'title' => $title,
            'danhmuc' => $data
        ]);
    }

    public function delete($id){
        $danhmuc = $this->model('danhmuc');
        $danhmuc->delete($id);
        header('location: /danhmuc' );
    }
    public function them(){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            return $this->view("danhmuc/them",[]);
        }
        else{
            /**
             * get data to post
             * save model 
             * redirect to danhmuc
             */

        }
    }


}