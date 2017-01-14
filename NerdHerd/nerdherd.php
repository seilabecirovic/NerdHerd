<?php
$db_server= getenv('NHERD_SERVICE_HOST');
$db_username=getenv('MYSQL_USER');
$db_pw = getenv('MYSQL_PASSWORD');
$db = getenv('MYSQL_DATABASE');

?>
<?php
function zag() {
    header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    header('Content-Type: text/html');
    header('Access-Control-Allow-Origin: *');
}
function rest_get($request, $data) {
  $veza = new PDO("mysql:dbname=".$db.";host=".$db_server, $db_username, $db_pw);
  $veza->exec("set names utf8");
if(isset($_GET['review'])){
  $id = $_GET['review'];

if($id!=null){
$upit = $veza->prepare("SELECT id,name,email,title,text FROM reviews WHERE id=?");
$upit->bindValue(1, $id, PDO::PARAM_INT);
$upit->execute();
print "{ \"reviews\": " . json_encode($upit->fetchAll()) . "}";
}
else {
  $upit = $veza->query("SELECT id,name,email,title,text FROM reviews");
  print "{ \"reviews\": " . json_encode($upit->fetchAll()) . "}";
}
}
}

function rest_post($request, $data) { }
function rest_delete($request) { }
function rest_put($request, $data) { }
function rest_error($request) { }

$method  = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];

switch($method) {
    case 'PUT':
        parse_str(file_get_contents('php://input'), $put_vars);
        zag(); $data = $put_vars; rest_put($request, $data); break;
    case 'POST':
        zag(); $data = $_POST; rest_post($request, $data); break;
    case 'GET':
        zag(); $data = $_GET; rest_get($request, $data); break;
    case 'DELETE':
        zag(); rest_delete($request); break;
    default:
        header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
        rest_error($request); break;
}
?>
