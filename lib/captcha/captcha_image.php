<?

require('php-captcha.inc.php');
$captcha = new PhpCaptcha();
$captcha->Create();

/*
require('php-captcha.inc.php');
$aFonts = array('fonts/VeraBd.ttf', 'fonts/VeraIt.ttf', 'fonts/Vera.ttf');
$oPhpCaptcha = new PhpCaptcha($aFonts, 150, 26);
$oPhpCaptcha->SetBackgroundImages('images/fondo.jpg');
$oPhpCaptcha->SetMinFontSize(14);
$oPhpCaptcha->SetMaxFontSize(16);
$oPhpCaptcha->SetCharSet('a-z,A-Z,0-9');
$oPhpCaptcha->SetNumChars(6);
$oPhpCaptcha->UseColour(255);
$oPhpCaptcha->RotateFont(true);
$oPhpCaptcha->Create();
*/
?>

