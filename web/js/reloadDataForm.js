$('#submitBtn').click(function() {
  
    $('#tipo').html($('#documentbundle_documento_tipoDocumento option:selected').text())
    $('#curso').html($('#documentbundle_documento_curso option:selected').text())
    
    //var file = document.getElementById("documentbundle_documento_documentFile");
    var inp = document.getElementById('documentbundle_documento_documentFile');
	var str='';
	for (var i = 0; i < inp.files.length; ++i) {
	   str += inp.files.item(i).name;
	   str += ' , ';
	  
	}
	
    $('#nombre').html(str)
  
  

});

$('#submit').click(function(){
    alert('submitting');
    $('#formfield').submit();
});