<?php
/****CAPTCHA TEMPORAL****/

session_start();

define('CAPTCHA_SESSION_ID', 'php_captcha');

class PhpCaptcha
{
	private $captchas = array(
						'captcha_image_01'=>'QTFALR',
						'captcha_image_02'=>'APXYKT',
						'captcha_image_03'=>'VRBGCA',
						'captcha_image_04'=>'DLHTKY',
						'captcha_image_05'=>'WEZDIN',
						'captcha_image_06'=>'OREYAQ',
						'captcha_image_07'=>'GFBPEY',
						'captcha_image_08'=>'LHBYEA',
						'captcha_image_09'=>'MGYPAH',
						'captcha_image_10'=>'VISKKF',
						'captcha_image_11'=>'SUIRKK',
						'captcha_image_12'=>'FYXCNX',
						'captcha_image_13'=>'JVJXPW',
						'captcha_image_14'=>'LTYJAE',
						'captcha_image_15'=>'YEPQPA',
						'captcha_image_16'=>'GDOIQL',
						'captcha_image_17'=>'FVLGWT',
						'captcha_image_18'=>'KQRTGD',
						'captcha_image_19'=>'ZHLENM',
						'captcha_image_20'=>'JKHRYQ',
						'captcha_image_21'=>'MLXWLC',
						'captcha_image_22'=>'ZDRCXG',
						'captcha_image_23'=>'DCOFYO',
						'captcha_image_24'=>'GUDARQ',
						'captcha_image_25'=>'PMLHWV',
						'captcha_image_26'=>'EVKHLT',
						'captcha_image_27'=>'GKEEAT',
						'captcha_image_28'=>'DSFBXK',
						'captcha_image_29'=>'OEJMXE',
						'captcha_image_30'=>'GTUIGD'
					);
	function PhpCaptcha(){}
	function Create()
	{
		$img = array_rand( $this->captchas, 1 );
		$_SESSION[CAPTCHA_SESSION_ID] = $this->captchas[$img];
		header("Content-type: image/jpg");
		readfile('./images/captchas/'.$img.'.jpg');
		exit();
	}
	
	function Validate( $code, $caseInsensitive = false )
	{
		if ( !empty($_SESSION[CAPTCHA_SESSION_ID]) && $_SESSION[CAPTCHA_SESSION_ID] == strtoupper($code) ){
			unset($_SESSION[CAPTCHA_SESSION_ID]);
			return true;
		}
		return false;
	}
}


/****fIN CAPTCHA TEMPORAL****/

/***************************************************************/
/*
PhpCaptcha - A visual and audio CAPTCHA generation library
Software License Agreement (BSD License)

Copyright (C) 2005-2006, Edward Eliot.
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

   * Redistributions of source code must retain the above copyright
     notice, this list of conditions and the following disclaimer.
   * Redistributions in binary form must reproduce the above copyright
     notice, this list of conditions and the following disclaimer in the
     documentation and/or other materials provided with the distribution.
   * Neither the name of Edward Eliot nor the names of its contributors 
     may be used to endorse or promote products derived from this software 
     without specific prior written permission of Edward Eliot.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDER AND CONTRIBUTORS "AS IS" AND ANY
EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

Last Updated:  18th April 2006

Documentation is available at http://www.ejeliot.com/pages/2

*/
/***************************************************************/

/*
session_start();

define('CAPTCHA_SESSION_ID', 'php_captcha');
define('CAPTCHA_WIDTH', 200); // max 500
define('CAPTCHA_HEIGHT', 50); // max 200
define('CAPTCHA_NUM_CHARS', 5);
define('CAPTCHA_NUM_LINES', 70);
define('CAPTCHA_OWNER_TEXT', '');
define('CAPTCHA_CHAR_SET', ''); // defaults to A-Z
define('CAPTCHA_CASE_INSENSITIVE', true);
define('CAPTCHA_BACKGROUND_IMAGES', '');
define('CAPTCHA_MIN_FONT_SIZE', 16);
define('CAPTCHA_MAX_FONT_SIZE', 25);
define('CAPTCHA_USE_COLOUR', 0);
define('CAPTCHA_ROTATE', true);
define('CAPTCHA_FILE_TYPE', 'jpeg');
define('CAPTCHA_FLITE_PATH', '/usr/bin/flite');
define('CAPTCHA_AUDIO_PATH', '/tmp/'); // must be writeable by PHP process

class PhpCaptcha {
   var $oImage;
   var $aFonts;
   var $iWidth;
   var $iHeight;
   var $iNumChars;
   var $iNumLines;
   var $iSpacing;
   var $sOwnerText;
   var $aCharSet;
   var $bCaseInsensitive;
   var $vBackgroundImages;
   var $iMinFontSize;
   var $iMaxFontSize;
   var $iUseColour;
   var $bRotate;
   var $sFileType;
   var $sCode = '';
   
   function PhpCaptcha(
      $aFonts, // array of TrueType fonts to use - specify full path
      $iWidth = CAPTCHA_WIDTH, // width of image
      $iHeight = CAPTCHA_HEIGHT // height of image
   ) {
      $this->aFonts = $aFonts;
      $this->SetNumChars(CAPTCHA_NUM_CHARS);
      $this->SetNumLines(CAPTCHA_NUM_LINES);
      $this->SetOwnerText(CAPTCHA_OWNER_TEXT);
      $this->SetCharSet(CAPTCHA_CHAR_SET);
      $this->CaseInsensitive(CAPTCHA_CASE_INSENSITIVE);
      $this->SetBackgroundImages(CAPTCHA_BACKGROUND_IMAGES);
      $this->SetMinFontSize(CAPTCHA_MIN_FONT_SIZE);
      $this->SetMaxFontSize(CAPTCHA_MAX_FONT_SIZE);
      $this->UseColour(CAPTCHA_USE_COLOUR);
      $this->RotateFont(CAPTCHA_ROTATE);
      $this->SetFileType(CAPTCHA_FILE_TYPE);   
      $this->SetWidth($iWidth);
      $this->SetHeight($iHeight);
   }
   
   function CalculateSpacing() {
      $this->iSpacing = (int)($this->iWidth / $this->iNumChars);
   }
   
   function SetWidth($iWidth) {
      $this->iWidth = $iWidth;
      if ($this->iWidth > 500) $this->iWidth = 500; // to prevent perfomance impact
      $this->CalculateSpacing();
   }
   
   function SetHeight($iHeight) {
      $this->iHeight = $iHeight;
      if ($this->iHeight > 200) $this->iHeight = 200; // to prevent performance impact
   }
   
   function SetNumChars($iNumChars) {
      $this->iNumChars = $iNumChars;
      $this->CalculateSpacing();
   }
   
   function SetNumLines($iNumLines) {
      $this->iNumLines = $iNumLines;
   }
   
   function SetOwnerText($sOwnerText) {
      $this->sOwnerText = $sOwnerText;
   }
   
   function SetCharSet($vCharSet) {
      if (is_array($vCharSet)) {
         $this->aCharSet = $vCharSet;
      }
   }
   
   function CaseInsensitive($bCaseInsensitive) {
      $this->bCaseInsensitive = $bCaseInsensitive;
   }
   
   function SetBackgroundImages($vBackgroundImages) {
      $this->vBackgroundImages = $vBackgroundImages;
   }
   
   function SetMinFontSize($iMinFontSize) {
      $this->iMinFontSize = $iMinFontSize;
   }
   
   function SetMaxFontSize($iMaxFontSize) {
      $this->iMaxFontSize = $iMaxFontSize;
   }
   
   function UseColour($iUseColour) {
      $this->iUseColour = $iUseColour;
   }
   
   function RotateFont($bRotate) {
      $this->bRotate = $bRotate;
   }
   
   function SetFileType($sFileType) {
      // check for valid file type
      if (in_array($sFileType, array('gif', 'png', 'jpeg'))) {
         $this->sFileType = $sFileType;
      } else {
         $this->sFileType = 'jpeg';
      }
   }
   
   function DrawLines() {
      for ($i = 0; $i < $this->iNumLines; $i++) {
         $iLineColour = imagecolorallocate($this->oImage, $this->iUseColour, $this->iUseColour, $this->iUseColour);
                     
         // draw line
         imageline($this->oImage, rand(0, $this->iWidth), rand(0, $this->iHeight), rand(0, $this->iWidth), rand(0, $this->iHeight), $iLineColour);
      }
   }
   
   function DrawOwnerText() {
      // allocate owner text colour
      $iBlack = imagecolorallocate($this->oImage, 0, 0, 0);
      // get height of selected font
      $iOwnerTextHeight = imagefontheight(2);
      // calculate overall height
      $iLineHeight = $this->iHeight - $iOwnerTextHeight - 4;
      
      // draw line above text to separate from CAPTCHA
      imageline($this->oImage, 0, $iLineHeight, $this->iWidth, $iLineHeight, $iBlack);
      
      // write owner text
      imagestring($this->oImage, 2, 3, $this->iHeight - $iOwnerTextHeight - 3, $this->sOwnerText, $iBlack);
      
      // reduce available height for drawing CAPTCHA
      $this->iHeight = $this->iHeight - $iOwnerTextHeight - 5;
   }
   
   function GenerateCode() {
      // reset code
      $this->sCode = '';
      
      // loop through and generate the code letter by letter
      for ($i = 0; $i < $this->iNumChars; $i++) {
         if (count($this->aCharSet) > 0) {
            // select random character and add to code string
            $this->sCode .= chr($this->aCharSet[array_rand($this->aCharSet)]);
         } else {
            // select random character and add to code string
            $this->sCode .= chr(rand(65, 90));
         }
      }
      
      // save code in session variable
      if ($this->bCaseInsensitive) {
         $_SESSION[CAPTCHA_SESSION_ID] = strtoupper($this->sCode);
      } else {
         $_SESSION[CAPTCHA_SESSION_ID] = $this->sCode;
      }
   }
   
   function DrawCharacters() {
      // loop through and write out selected number of characters
      for ($i = 0; $i < strlen($this->sCode); $i++) {
         // select random font
         $sCurrentFont = $this->aFonts[array_rand($this->aFonts)];
         
         $iTextColour = imagecolorallocate($this->oImage, $this->iUseColour, $this->iUseColour, $this->iUseColour);

         // select random font size
         $iFontSize = rand($this->iMinFontSize, $this->iMaxFontSize);
         
         // select random angle
         $iAngle = 0;
         if ($this->bRotate) $iAngle = rand(-30, 30);
         
         // get dimensions of character in selected font and text size
         $aCharDetails = imageftbbox($iFontSize, $iAngle, $sCurrentFont, $this->sCode[$i], array());
         
         // calculate character starting coordinates
         $iX = $this->iSpacing / 4 + $i * $this->iSpacing;
         $iCharHeight = $aCharDetails[2] - $aCharDetails[5];
         $iY = $this->iHeight / 2 + $iCharHeight / 4; 
         
         // write text to image
         imagefttext($this->oImage, $iFontSize, $iAngle, $iX, $iY, $iTextColour, $sCurrentFont, $this->sCode[$i], array());
         
      }
   }
   
   function WriteFile($sFilename) {
      if ($sFilename == '') {
         // tell browser that data is jpeg
         header("Content-type: image/$this->sFileType");
      }
      
      switch ($this->sFileType) {
         case 'gif':
            $sFilename != '' ? imagegif($this->oImage, $sFilename) : imagegif($this->oImage);
            break;
         case 'png':
            $sFilename != '' ? imagepng($this->oImage, $sFilename) : imagepng($this->oImage);
            break;
         default:
            $sFilename != '' ? imagejpeg($this->oImage, $sFilename) : imagejpeg($this->oImage);
      }
   }
   
   function Create($sFilename = '') {
      // check for required gd functions
      if (!function_exists('imagecreate') || !function_exists("image$this->sFileType") || ($this->vBackgroundImages != '' && !function_exists('imagecreatetruecolor'))) {
         return false;
      }
      
      // get background image if specified and copy to CAPTCHA
      if (is_array($this->vBackgroundImages) || $this->vBackgroundImages != '') {
         // create new image
         $this->oImage = imagecreatetruecolor($this->iWidth, $this->iHeight);
         
         // create background image
         if (is_array($this->vBackgroundImages)) {
            $iRandImage = array_rand($this->vBackgroundImages);
            $oBackgroundImage = imagecreatefromjpeg($this->vBackgroundImages[$iRandImage]);
         } else {
            $oBackgroundImage = imagecreatefromjpeg($this->vBackgroundImages);
         }
         
         // copy background image
         imagecopy($this->oImage, $oBackgroundImage, 0, 0, 0, 0, $this->iWidth, $this->iHeight);
         
         // free memory used to create background image
         imagedestroy($oBackgroundImage);
      } else {
         // create new image
         $this->oImage = imagecreate($this->iWidth, $this->iHeight);
      }
      
      // allocate white background colour
      imagecolorallocate($this->oImage, 255, 255, 255);
      
      // check for owner text
      if ($this->sOwnerText != '') {
         $this->DrawOwnerText();
      }
      
      // check for background image before drawing lines
      if (!is_array($this->vBackgroundImages) && $this->vBackgroundImages == '') {
         $this->DrawLines();
      }
      
      $this->GenerateCode();
      $this->DrawCharacters();
      
      // write out image to file or browser
      $this->WriteFile($sFilename);
      
      // free memory used in creating image
      imagedestroy($this->oImage);
      
      return true;
   }
   
   // call this method statically
   function Validate($sUserCode, $bCaseInsensitive = true) {
      if ($bCaseInsensitive) {
         $sUserCode = strtoupper($sUserCode);
      }
      
      if (!empty($_SESSION[CAPTCHA_SESSION_ID]) && $sUserCode == $_SESSION[CAPTCHA_SESSION_ID]) {
         // clear to prevent re-use
         unset($_SESSION[CAPTCHA_SESSION_ID]);
         
         return true;
      }
      
      return false;
   }
}

// this class will only work correctly if a visual CAPTCHA has been created first using PhpCaptcha
class AudioPhpCaptcha {
   var $sFlitePath;
   var $sAudioPath;
   var $sCode;
   
   function AudioPhpCaptcha(
      $sFlitePath = CAPTCHA_FLITE_PATH, // path to flite binary
      $sAudioPath = CAPTCHA_AUDIO_PATH // the location to temporarily store the generated audio CAPTCHA
   ) {
      $this->SetFlitePath($sFlitePath);
      $this->SetAudioPath($sAudioPath);
      
      // retrieve code if already set by previous instance of visual PhpCaptcha
      if (isset($_SESSION[CAPTCHA_SESSION_ID])) {
         $this->sCode = $_SESSION[CAPTCHA_SESSION_ID];
      }
   }
   
   function SetFlitePath($sFlitePath) {
      $this->sFlitePath = $sFlitePath;
   }
   
   function SetAudioPath($sAudioPath) {
      $this->sAudioPath = $sAudioPath;
   }
   
   function Mask($sText) {
      $iLength = strlen($sText);
      
      // loop through characters in code and format
      $sFormattedText = '';
      for ($i = 0; $i < $iLength; $i++) {
         // comma separate all but first and last characters
         if ($i > 0 && $i < $iLength - 1) {
            $sFormattedText .= ', ';
         } elseif ($i == $iLength - 1) { // precede last character with "and"
            $sFormattedText .= ' and ';
         }
         $sFormattedText .= $sText[$i];
      }
      
      $aPhrases = array(
         "The %1\$s characters are as follows: %2\$s",
         "%2\$s, are the %1\$s letters",
         "Here are the %1\$s characters: %2\$s",
         "%1\$s characters are: %2\$s",
         "%1\$s letters: %2\$s"
      );
      
      $iPhrase = array_rand($aPhrases);
      
      return sprintf($aPhrases[$iPhrase], $iLength, $sFormattedText);
   }
   
   function Create() {
      $sText = $this->Mask($this->sCode);
      $sFile = md5($this->sCode.time());
      
      // create file with flite
      shell_exec("$this->sFlitePath -t \"$sText\" -o $this->sAudioPath$sFile.wav");
      
      // set headers
      header('Content-type: audio/x-wav');
      header("Content-Disposition: attachment;filename=$sFile.wav");
      
      // output to browser
      echo file_get_contents("$this->sAudioPath$sFile.wav");
      
      // delete temporary file
      @unlink("$this->sAudioPath$sFile.wav");
   }
}
*/
?>
