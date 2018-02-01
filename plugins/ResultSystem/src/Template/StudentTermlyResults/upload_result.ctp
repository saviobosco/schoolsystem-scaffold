<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Upload Result </h4>
            </div>
            <div class="panel-body">

            </div>
        </div>
    </div>
</div>
<script>
    var handleResultUpload = function() {
        $('#result-form-upload').submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url:'<?= $this->Url->build(['plugin'=>'ResultSystem','controller'=>'StudentTermlyResults','action'=>'upload_result'], true) ?>' ,
                contentType:false,
                cache:false,
                processData:false,
                data:/* $(this).serialize()*/ new FormData(this),
                beforeSend:function(){
                    $('#ajax-request-feedback').html('<div class="alert alert-info"> <i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Uploading result, Please be patient this might take a while ... </div>');
                },
                success: function(data,status){
                    //$( ".result" ).html( data );
                    //$('#ajax-request-feedback').empty();
                    $('#ajax-request-feedback').html(data);
                    //document.getElementById("result-form-upload").reset();
                },
                dataType: 'text'
            });
        })
    };
    handleResultUpload();
</script>