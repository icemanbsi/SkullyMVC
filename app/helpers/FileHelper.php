<?php
/**
 * Created by Jay from TrioDesign (trio@tgitriodesign.com).
 * User: Bobby Stenly Irawan
 * Date: 4/30/13
 * Time: 5:47 PM
 *
 */
namespace App\Helpers;
class FileHelper
{
	// Save image from given image data then return its file url on success.
	// $base64 is image string passed from canvas.toDataURL()
	public function saveImage($base64, $filePath, $fileNameNoExt){
		$matches = array();
		$t = preg_match('/\/(.*?)\;/s', $base64, $matches);
		if(empty($matches[1])) return false;
		$ext = $matches[1];

		if(empty($ext)) return false;

		if(!is_dir($filePath))
			mkdir($filePath, 0777, true);

		$filePath = $filePath . $fileNameNoExt . "." . $ext;

		$base64 = substr($base64, strpos($base64, ",")+1);

		$res = file_put_contents($filePath, base64_decode($base64));
		if($res === false)return false;
		return $filePath;
	}

	// Validates given image data
	// $base64 is image string passed from canvas.toDataURL()
	public function validatesImageData($base64) {
		$base64 = substr($base64, strpos($base64, ",")+1);

		$decodedData = base64_decode($base64);
		$im = @imagecreatefromstring($decodedData);
		if ($im === false) {
			return false;
		}
		else {
			return true;
		}
	}

	public function remove($file){
		unlink($file);
	}

	public function parseBytes($size_str)
	{
		switch (substr ($size_str, -1))
		{
			case 'M': case 'm': return (int)$size_str * 1048576;
			case 'K': case 'k': return (int)$size_str * 1024;
			case 'G': case 'g': return (int)$size_str * 1073741824;
			default: return $size_str;
		}
	}

	// Save uploaded image to cache
	// can accept $_FILES['image'] as its attribute.
	// This is only used in cases where browser doesn't have File API.
	// $errors = array of errors.
	public function saveUploadedImageToCache($file, $name, &$errors) {
		$photoData = false;
		if(!empty($file["tmp_name"])){
			if($file["type"] == "image/jpeg" ||
				$file["type"] == "image/png"){
				$filePath = app()->config("imagecachesPath") . $name;
				$fileUrl = app()->config("imagecachesUrl") . $name;
				move_uploaded_file($file["tmp_name"], $filePath);
				$photoData["path"] = $filePath;
				$photoData["url"] = $fileUrl;

				$imageProcessor = app()->helper("ImageProcessor");
				$imageProcessor::resize($photoData['path'], array(
					'curl' => true,
					'maxCurlSize' => 10,
					'w' => app()->config("resizeLarge")));

			}
			else { //wrong format
				$errors[] = array('attribute' => 'photo', 'message' => lang('modelCampaignPhotoErrorTypeMismatch'));
			}
		}
		else{
			//need to tell user to upload a file
			$errors[] = array('attribute' => 'photo', 'message' => lang('modelCampaignPhotoErrorUploadPhotoRequired'));
		}
		return $photoData;
	}

	// Get image from url, save it to cache, then return photoData.
	public function saveImageUrlToCache($url) {
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		curl_close($ch);
		$nameParts = explode('.', $url);
		$extension = $nameParts[count($nameParts)-1];
		$fileName = (time() + rand(1, 1000)).'.'.$extension; //add rand() to make duplicate name possibility smaller

		$filePath = app()->config("imagecachesPath") . $fileName;
		$fileUrl = app()->config("imagecachesUrl") . $fileName;

		$file = fopen($filePath, 'w+');
		fputs($file, $data);
		fclose($file);

		return array('path' => $filePath, 'url' => $fileUrl);
	}

	// Save image data from image data (base 16 string)
	// In order to save this successfully, entry must have saved in database.
	public function saveImageFromData($data, $campaignEntryId = '') {
		$photoData = array();
		$fileName = md5(time() . $this->attributes['userId']);
		if (empty($campaignEntryId)) {
			errorLog("Image not saved because campaignEntry has no Id, perhaps something was forgotten?");
			debugBacktrace();
		}
		else {
			$filePath = 'images/entries/' . $campaignEntryId . '/';
			$fileUrl = app()->helper("FileHelper")->saveImage($data, $filePath, $fileName);
			$photoData['path'] = $filePath;
			$photoData['url'] = $fileUrl;
		}
		return $photoData;
	}
}
