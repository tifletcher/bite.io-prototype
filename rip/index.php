<?

/* Request Method is POST || 405: Method Not Allowed */
if($_SERVER['REQUEST_METHOD'] !== 'POST')
  {
    http_response_code(405);
    exit;
  }

/* POST has data || 400: Bad Request */
if(empty($_POST))
  {
    http_response_code(400);
    exit;
  }


print_r($_POST);

?>
