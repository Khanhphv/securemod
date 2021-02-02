
@if(count($keys) > 0) 
	<div class="form-group">
		<label for="comment">Cheat ID: {{$keys[0]->tool_id}}. Package: {{$keys[0]->package}} hours. Quality: {{count($keys)}}</label> <br> <br>
		<div class="form-control" id="selectable" onclick="selectText('selectable')">
			@foreach($keys as $key)
			{{str_replace(PHP_EOL,'',$key->key)}}<br>
			@endforeach
		</div>
	</div>
@else
<h3>There is no key in this transaction.</h3>
@endif
<script type="text/javascript">
	function selectText(containerid) {
    if (document.selection) { // IE
        var range = document.body.createTextRange();
        range.moveToElementText(document.getElementById(containerid));
        range.select();
    } else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById(containerid));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
    }
	}
</script>