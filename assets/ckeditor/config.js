/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
	config.extraPlugins = 'justify';
	//config.extraPlugins = '';
	config.enterMode = CKEDITOR.ENTER_BR; // <p></p> to <br />
	config.entities = false;
	config.basicEntities = false;
	config.htmlEncodeOutput = false;
};

CKEDITOR.on('dialogDefinition', function (ev) {

    var dialogName = ev.data.name,
        dialogDefinition = ev.data.definition;

    if (dialogName == 'image') {
        var onOk = dialogDefinition.onOk;

        dialogDefinition.onOk = function (e) {
            var width = this.getContentElement('info', 'txtWidth');
            width.setValue('200');//Set Default Width

            var height = this.getContentElement('info', 'txtHeight');
            height.setValue('200');////Set Default height

            onOk && onOk.apply(this, e);
        };
    }
});

CKEDITOR.on( 'instanceCreated', function( event ) {
 editor.on( 'configLoaded', function() {

  editor.config.basicEntities = false;
  editor.config.entities_greek = false; 
  editor.config.entities_latin = false; 
  editor.config.entities_additional = '';

 });
});
