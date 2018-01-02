<?php
/*
* Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
* For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * \brief CKEditor class that can be used to create editor
 * instances in PHP pages on server side.
 * @see http://ckeditor.com
 *
 * Sample usage:
 * @code
 * $CKEditor = new CKEditor();
 * $CKEditor->editor("editor1", "<p>Initial value.</p>");
 * @endcode
 */
class CKEditor
{
	/**
	 * The version of %CKEditor.
	 */
	const version = '3.6.2';
	/**
	 * A constant string unique for each release of %CKEditor.
	 */
	const timestamp = 'B8DJ5M3';

	/**
	 * URL to the %CKEditor installation directory (absolute or relative to document root).
	 * If not set, CKEditor will try to guess it's path.
	 *
	 * Example usage:
	 * @code
	 * $CKEditor->basePath = '/ckeditor/';
	 * @endcode
	 */
	public $basePath;
	/**
	 * An array that holds the global %CKEditor configuration.
	 * For the list of available options, see http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html
	 *
	 * Example usage:
	 * @code
	 * $CKEditor->config['height'] = 400;
	 * // Use @@ at the beggining of a string to ouput it without surrounding quotes.
	 * $CKEditor->config['width'] = '@@screen.width * 0.8';
	 * @endcode
	 */
	public $config = array();
	/**
	 * A boolean variable indicating whether CKEditor has been initialized.
	 * Set it to true only if you have already included
	 * &lt;script&gt; tag loading ckeditor.js in your website.
	 */
	public $initialized = false;
	/**
	 * Boolean variable indicating whether created code should be printed out or returned by a function.
	 *
	 * Example 1: get the code creating %CKEditor instance and print it on a page with the "echo" function.
	 * @code
	 * $CKEditor = new CKEditor();
	 * $CKEditor->returnOutput = true;
	 * $code = $CKEditor->editor("editor1", "<p>Initial value.</p>");
	 * echo "<p>Editor 1:</p>";
	 * echo $code;
	 * @endcode
	 */
	public $returnOutput = false;
	/**
	 * An array with textarea attributes.
	 *
	 * When %CKEditor is created with the editor() method, a HTML &lt;textarea&gt; element is created,
	 * it will be displayed to anyone with JavaScript disabled or with incompatible browser.
	 */
	public $textareaAttributes = array( "rows" => 8, "cols" => 60 );
	/**
	 * A string indicating the creation date of %CKEditor.
	 * Do not change it unless you want to force browsers to not use previously cached version of %CKEditor.
	 */
	public $timestamp = "B8DJ5M3";
	/**
	 * An array that holds event listeners.
	 */
	private $events = array();
	/**
	 * An array that holds global event listeners.
	 */
	private $globalEvents = array();

	/**
	 * Main Constructor.
	 *
	 *  @param $basePath (string) URL to the %CKEditor installation directory (optional).
	 */
	function __construct($basePath = null) {
		if (!empty($basePath)) {
			$this->basePath = $basePath;
		}
	}

	/**
	 * Creates a %CKEditor instance.
	 * In incompatible browsers %CKEditor will downgrade to plain HTML &lt;textarea&gt; element.
	 *
	 * @param $name (string) Name of the %CKEditor instance (this will be also the "name" attribute of textarea element).
	 * @param $value (string) Initial value (optional).
	 * @param $config (array) The specific configurations to apply to this editor instance (optional).
	 * @param $events (array) Event listeners for this editor instance (optional).
	 *
	 * Example usage:
	 * @code
	 * $CKEditor = new CKEditor();
	 * $CKEditor->editor("field1", "<p>Initial value.</p>");
	 * @endcode
	 *
	 * Advanced example:
	 * @code
	 * $CKEditor = new CKEditor();
	 * $config = array();
	 * $config['toolbar'] = array(
	 *     array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
	 *     array( 'Image', 'Link', 'Unlink', 'Anchor' )
	 * );
	 * $events['instanceReady'] = 'function (ev) {
	 *     alert("Loaded: " + ev.editor.name);
	 * }';
	 * $CKEditor->editor("field1", "<p>Initial value.</p>", $config, $events);
	 * @endcode
	 */
	public function editor($name, $value = "", $config = array(), $events = array())
	{
		$attr = "";
		foreach ($this->textareaAttributes as $key => $val) {
			$attr.= " " . $key . '="' . str_replace('"', '&quot;', $val) . '"';
		}
		$out = "<textarea name=\"" . $name . "\"" . $attr . ">" . htmlspecialchars($value) . "</textarea>\n";
		if (!$this->initialized) {
			$out .= $this->init();
		}

		$_config = $this->configSettings($config, $events);

		$js = $this->returnGlobalEvents();
		if (!empty($_config))
			$js .= "CKEDITOR.replace('".$name."', ".$this->jsEncode($_config).");";
		else
			$js .= "CKEDITOR.replace('".$name."');";

		$out .= $this->script($js);

		if (!$this->returnOutput) {
			print $out;
			$out = "";
		}

		return $out;
	}

	/**
	 * Replaces a &lt;textarea&gt; with a %CKEditor instance.
	 *
	 * @param $id (string) The id or name of textarea element.
	 * @param $config (array) The specific configurations to apply to this editor instance (optional).
	 * @param $events (array) Event listeners for this editor instance (optional).
	 *
	 * Example 1: adding %CKEditor to &lt;textarea name="article"&gt;&lt;/textarea&gt; element:
	 * @code
	 * $CKEditor = new CKEditor();
	 * $CKEditor->replace("article");
	 * @endcode
	 */
	public function replace($id, $config = array(), $events = array())
	{
		$out = "";
		if (!$this->initialized) {
			$out .= $this->init();
		}

		$_config = $this->configSettings($config, $events);

		$js = $this->returnGlobalEvents();
		if (!empty($_config)) {
			$js .= "CKEDITOR.replace('".$id."', ".$this->jsEncode($_config).");";
		}
		else {
			$js .= "CKEDITOR.replace('".$id."');";
		}
		$out .= $this->script($js);

		if (!$this->returnOutput) {
			print $out;
			$out = "";
		}

		return $out;
	}

	/**
	 * Replace all &lt;textarea&gt; elements available in the document with editor instances.
	 *
	 * @param $className (string) If set, replace all textareas with class className in the page.
	 *
	 * Example 1: replace all &lt;textarea&gt; elements in the page.
	 * @code
	 * $CKEditor = new CKEditor();
	 * $CKEditor->replaceAll();
	 * @endcode
	 *
	 * Example 2: replace all &lt;textarea class="myClassName"&gt; elements in the page.
	 * @code
	 * $CKEditor = new CKEditor();
	 * $CKEditor->replaceAll( 'myClassName' );
	 * @endcode
	 */
	public function replaceAll($className = null)
	{
		$out = "";
		if (!$this->initialized) {
			$out .= $this->init();
		}

		$_config = $this->configSettings();

		$js = $this->returnGlobalEvents();
		if (empty($_config)) {
			if (empty($className)) {
				$js .= "CKEDITOR.replaceAll();";
			}
			else {
				$js .= "CKEDITOR.replaceAll('".$className."');";
			}
		}
		else {
			$classDetection = "";
			$js .= "CKEDITOR.replaceAll( function(textarea, config) {\n";
			if (!empty($className)) {
				$js .= "	var classRegex = new RegExp('(?:^| )' + '". $className ."' + '(?:$| )');\n";
				$js .= "	if (!classRegex.test(textarea.className))\n";
				$js .= "		return false;\n";
			}
			$js .= "	CKEDITOR.tools.extend(config, ". $this->jsEncode($_config) .", true);";
			$js .= "} );";

		}

		$out .= $this->script($js);

		if (!$this->returnOutput) {
			print $out;
			$out = "";
		}

		return $out;
	}

	/**
	 * Adds event listener.
	 * Events are fired by %CKEditor in various situations.
	 *
	 * @param $event (string) Event name.
	 * @param $javascriptCode (string) Javascript anonymous function or function name.
	 *
	 * Example usage:
	 * @code
	 * $CKEditor->addEventHandler('instanceReady', 'function (ev) {
	 *     alert("Loaded: " + ev.editor.name);
	 * }');
	 * @endcode
	 */
	public function addEventHandler($event, $javascriptCode)
	{
		if (!isset($this->events[$event])) {
			$this->events[$event] = array();
		}
		// Avoid duplicates.
		if (!in_array($javascriptCode, $this->events[$event])) {
			$this->events[$event][] = $javascriptCode;
		}
	}

	/**
	 * Clear registered event handlers.
	 * Note: this function will have no effect on already created editor instances.
	 *
	 * @param $event (string) Event name, if not set all event handlers will be removed (optional).
	 */
	public function clearEventHandlers($event = null)
	{
		if (!empty($event)) {
			$this->events[$event] = array();
		}
		else {
			