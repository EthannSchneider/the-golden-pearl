<?php 

require "util/response_utils.php";
require "util/auth_utils.php";
require "util/meals_utils.php";

$_POST = json_decode(file_get_contents('php://input'), true);

header("content-type: application/json; charset=utf-8");

$dir = scandir("controller");

foreach($dir as $file) {
    if(in_array($file, [".", ".."])) {
        continue;
    }

    include_once("controller/$file");

    if (!isset($entry)) {
        continue;
    }

    foreach($entry as $class => $method) {
        if (!isset($method[$_SERVER['REQUEST_METHOD']])) {
            continue;
        }
        foreach($method[$_SERVER['REQUEST_METHOD']] as $api => $func) {
            $same_route = true;
            $replace_var = [];
            $api_splited = explode("/", $api);
            $route_splited = explode("/", $route);
            if (sizeof($api_splited) != sizeof($route_splited)) {
                $same_route = false;
            }else {
                foreach($api_splited as $i => $part) {
                    if(!isset($route_splited[$i])) {
                        $same_route = false;
                        break;
                    }
                    if($part != $route_splited[$i]) {
                        if ($part[0] == ":") {
                            if (preg_match("/^[a-zA-Z1-9_ -]{1,}$/", $route_splited[$i]) == 0) {
                                $same_route = false;
                                break;
                            }
                            $replace_var[$part] = $route_splited[$i];
                        }else {
                            $same_route = false;
                            break;
                        }
                    }
                }
            }

            if($same_route) {
                eval("\$inst = new " . $class . ";");

                if(sizeof($replace_var) > 0) {
                    foreach($replace_var as $key => $value) {
                        $func = str_replace($key, "\"$value\"", $func);
                    }
                }
                
                eval("\$inst->" . $func . ";");
                exit;
            }
        }
    }
}

header('HTTP/1.0 404 Not Found');
echo '{"success": true, "message": "Request not found"}';