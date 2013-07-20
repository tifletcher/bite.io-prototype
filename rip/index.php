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

$url = escapeshellarg($_POST['url']);
$start_time = escapeshellarg('00:00:'.str_pad($_POST['start_time'], 2, '0', STR_PAD_LEFT));
$duration = escapeshellarg('00:00:'.str_pad($_POST['duration'], 2, '0', STR_PAD_LEFT));

$output_filename = sha1(microtime()).'.webm';
$output_path = dirname(__FILE__).'/../v/'.$output_filename;
$cmd = 'youtube-dl '.$url.' -o - | avconv -i - -ss '.$start_time.' -t '.$duration.' '.$output_path;

error_log($cmd);
shell_exec($cmd . ' >/dev/null 2>/dev/null &');

header('Location: /?'.$output_filename);
/* $response = array('video' => 'http://dogfoo.de/v/'.$output_filename, */
/*                   'thumbnail' => 0); */

echo json_encode($response);
?>
