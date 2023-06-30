<?php


    class Route {

        public function __construct() {

            $url = $this->getUrl();

            switch ($url) {
                case 'logout':
                    $this->Logout();
                    $this->Redirect('http://localhost/clearancems/admin/', ['success', 'Logout Success!']);
                    break;
                
                default:
                    # code...
                    break;
            }
            return $url;
        }


        public function getUrl()
        {
            if(isset($_GET['url']) || (isset($_GET['id']) && isset($_GET['req'])) )
            {
                if(!isset($_GET['url']) && (isset($_GET['id']) && isset($_GET['req'])))
                {
                    $url = [$_GET['id'], $_GET['req']];

                    return $url;
                }
                elseif (isset($_GET['url'])) {
                    $url = $_GET['url'];

                    return $url;
                }
                
            }
    
        }

        public function Logout()
        {
            session_destroy();
            unset($_SESSION['admin']);
        }

        public function Redirect($url, $params = [])
        {
            return header("Location: " . $url . "?param=" . $params[0] . "&message=" . urlencode($params[1]) );
        }



    }

    //   