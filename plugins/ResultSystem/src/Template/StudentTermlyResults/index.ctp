<?php
// including the search parameter element
echo $this->element('searchParametersSessionClassTerm');
$queryData = $this->request->getQuery();
?>


<div class="row m-t-30">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= ((int)$queryData['term_id'] === 4) ? __('Student Annual Positions') : __('Student Termly Positions')  ?> </h4>
            </div>
            <div class="panel-body">

            </div>
        </div>
    </div>
</div>