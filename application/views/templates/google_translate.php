<script>
	function get_lang()
	{
        var lang = get_lang_from_url();
        lang = (lang == "") ? "en" : lang;
        console.log("get_lang() = " + lang);
		
		return lang;
	}
</script>


<div id="google_translate_element"></div>

<script type="text/javascript" src="//<?= str_replace("http://", "", site_url()) ?>assets/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script type="text/javascript">
    
    function googleTranslateElementInit() {
        var default_lang = "en";
        var target_lang = get_lang();
        new google.translate.TranslateElement(
            {
                pageLanguage: default_lang, 
                includedLanguages: target_lang
            }, 
            'google_translate_element');
        
        console.log("googleTranslateElementInit() completed");
    }
</script>


<style>
/* Hide Google Translate Bars */
.goog-te-banner-frame, .skiptranslate { display: none !important; } 
body { top: 0px !important; }
</style>