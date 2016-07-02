<?php
// Copyright (c) 2016-2017 Andrea Zanellato
// This file may be used and distributed under the terms of the public license.

class YellowBootstrapMarkdown
{
	const Version = "0.0.1";
	var $yellow;

	// Handle initialisation
	function onLoad($yellow)
	{
		$this->yellow = $yellow;
		if(!$this->yellow->config->isExisting("jqueryCdn"))
		{
			$this->yellow->config->setDefault("jqueryCdn",
				"https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/");
		}
		if(!$this->yellow->config->isExisting("bootstrapCdnCSS"))
		{
			$this->yellow->config->setDefault("bootstrapCdnCSS",
				"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/");
        }
		if(!$this->yellow->config->isExisting("bootstrapCdnJS"))
		{
			$this->yellow->config->setDefault("bootstrapCdnJS",
				"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/");
        }
		$this->yellow->config->setDefault("markedCdn",
			"https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.5/");
/*
	TODO: Do we need DropZone support?
	Drag&drop can be done without dropzone.js and file management should be
	better to be done with a filemanager instead
*/
//		$this->yellow->config->setDefault("dropZoneCdn",
//			"https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/");

		$this->yellow->config->setDefault("bootstrapMarkdownCdn",
			"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.10.0/");
	}

	// Handle page extra HTML data
	function onExtra($name)
	{
		$output = NULL;
		if($name == "header")
		{
			$jqCDN  = $this->yellow->config->get("jqueryCdn");
			$bsJS   = $this->yellow->config->get("bootstrapCdnJS");
			$bsCSS  = $this->yellow->config->get("bootstrapCdnCSS");
			$mkdCdn = $this->yellow->config->get("markedCdn");
//			$dznCdn = $this->yellow->config->get("dropZoneCdn");
			$bsmCdn = $this->yellow->config->get("bootstrapMarkdownCdn");
			$bsmPth = $this->yellow->config->get("serverBase").
			          $this->yellow->config->get("pluginLocation");

			$output .= "<script type=\"text/javascript\" src=\"{$jqCDN}jquery.min.js\"></script>\n";
			$output .= "<script type=\"text/javascript\" src=\"{$bsJS}bootstrap.min.js\"></script>\n";
			$output .= "<script type=\"text/javascript\" src=\"{$mkdCdn}marked.min.js\"></script>\n";
//			$output .= "<script type=\"text/javascript\" src=\"{$dznCdn}dropzone.min.js\"></script>\n";
			$output .= "<script type=\"text/javascript\" src=\"{$bsmCdn}js/bootstrap-markdown.min.js\"></script>\n";
			$output .= "<script type=\"text/javascript\" src=\"{$bsmPth}bootstrap-markdown.js\"></script>\n";
			$output .= "<link rel=\"stylesheet\" href=\"{$bsCSS}bootstrap.min.css\">\n";
//			$output .= "<link rel=\"stylesheet\" href=\"{$dznCdn}dropzone.min.css\">\n";
			$output .= "<link rel=\"stylesheet\" href=\"{$bsmCdn}css/bootstrap-markdown.min.css\">\n";
		}
		return $output;
	}
}

$yellow->plugins->register("bootstrap-markdown", "YellowBootstrapMarkdown", YellowBootstrapMarkdown::Version);
?>
