// Copyright (c) 2016 Andrea Zanellato
// This file may be used and distributed under the terms of the public license.

// BootstrapMarkdown plugin 0.6.4
var initBootstrapMarkdownFromDOM = function() {

	$("#yellow-pane-edit-page").markdown();

// http://stackoverflow.com/questions/12214057/drag-n-drop-text-file

	function handleFileSelect(evt) {
		evt.stopPropagation();
		evt.preventDefault();

		var files  = evt.dataTransfer.files; // FileList object.
		var reader = new FileReader();

		reader.onload = function(event) {
			document.getElementById('yellow-pane-edit-page').value = event.target.result;
		}
		reader.readAsText(files[0],"UTF-8");
	}

	function handleDragOver(evt) {
		evt.stopPropagation();
		evt.preventDefault();
		evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
	}

	// Setup the dnd listeners.
	var dropZone = document.getElementById('yellow-pane-edit-page');
	if(dropZone) {
		dropZone.addEventListener('dragover', handleDragOver, false);
		dropZone.addEventListener('drop', handleFileSelect, false);
	}
}

if(window.addEventListener) {
	window.addEventListener('load', initBootstrapMarkdownFromDOM, false);
} else {
	window.attachEvent('onload', initBootstrapMarkdownFromDOM);
}
