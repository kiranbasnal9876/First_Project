<?php

namespace Mpdf\File;

class LocalContentLoader implements \Mpdf\File\LocalContentLoaderInterface
{

	public function load($path)
	{
		// print_r($path);die;
		
		return file_get_contents($path);
	}

}
