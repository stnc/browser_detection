<?php
/*
################################################################################
#                                Browser Detector                              #
################################################################################
# Class Name: Browser Detector                                                 #
# Script-Version:     1.0                                                      #
# File-Release-Date:  2010/11/24                                               #
# Official web site and latest version:                                        #
#==============================================================================#
# Authors:Selman Tunç stncweb@gmail.com)  @Lars Echterhoff (lars.echterhoff@gmail.com)	              
#                                                                              #
################################################################################
*/
/* Licence
 * #############################################################################
 * | This program is free software; you can redistribute it and/or             |
 * | modify it under the terms of the GNU General var License              	   |
 * | as published by the Free Software Foundation; either version 2            |
 * | of the License, or (at your option) any later version.                    |
 * |                                                                           |
 * | This program is distributed in the hope that it will be useful,           |
 * | but WITHOUT ANY WARRANTY; without even the implied warranty of            |
 * | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             |
 * | GNU General var License for more details.                            	   |
 * |                                                                           |
 * +---------------------------------------------------------------------------+
 */
 
/*
	Usage:
	$detect = new detector($_SERVER["HTTP_USER_AGENT"]);
	echo $detect->get("browser");
	
	or
	
	echo $detect->getall();
	
	or
	
	echo $detect->is("mobilebrowser");
*/
class detector {
	private $pattern;
	
	function __construct($agent)
	{
		include_once("ua.footprintref.php");
		$this->agent = $agent;
	}
	
  private function detect($pattern,$rxblock=2)
  {
		$patvar = "is_".$pattern;
		$patstr = $pattern;
		foreach($this->pattern[$pattern] as $match_pattern => $qualified)
		{
			if( preg_match("/".$match_pattern."/i",$this->agent,$match) )
			{
				$this->{$patvar} = true;
				$this->{$patstr} = trim($qualified." ");//$match[$rxblock]
				return $this->{$patstr};
			}
		}
		$this->{$patvar} = false;
		return false;
  }
  function getall(){
  	foreach($this->pattern as $key => $foo)
  	{
  		$this->get($key);
  	}
  	$this->get("language");
  	return $this->browser." / ".$this->operatingsystem." / ".$this->language;
  }
  function is($pattern)
  {
  	$this->get($pattern);
  	$patis = "is_".$pattern;
  	return $this->{$patis};
  }
  function get($pattern)
  {
  	if($pattern=="language") return $this->lang_detection();
  	if(!$this->pattern[$pattern]) return false;
  	$rxblock = 2;
  	if($pattern=="basicbrowser") $rxblock = 1;
  	return $this->detect($pattern,$rxblock);
  }
	private function lang_detection()
	{
		$lang = preg_split('/[,;]/',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
		$lang = strtolower($lang[0]);
		$lang = preg_split('/[-]/',$lang);
		return $this->browser_lang = $lang[0];
	}
	/* Legacy functions */
	function mobile_browser_detection(){return $this->get("mobilebrowser");}
	function browser_detection(){return $this->get("browser");}
	function vip_bot_detection(){return $this->get("vipbots");}
	function browser_lang_detection(){return $this->get("language");}
	function robot_detection(){return $this->get("robots");}
	function operating_system_detection(){return $this->get("operatingsystem");}
	function basic_browser_detection(){return $this->get("basicbrowser");}

}
?>
