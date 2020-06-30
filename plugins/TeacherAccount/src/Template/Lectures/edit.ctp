<?php
/**
 * @var \App\View\AppView $this
 */

$this->extend('/Common/view');
$this->assign('title', 'Create Lecture');
?>

<?= $this->Form->create($lecture) ?>
<fieldset>
    <legend><?= __('Add New Lecture') ?></legend>
    <?php
    echo $this->Form->control('subject_id', ['options' => $subjects]);
    echo $this->Form->control('session_id', ['options' => $sessions]);
    echo $this->Form->control('class_id', ['options' => $classes]);
    echo $this->Form->control('term_id', ['options' => $terms]);
    echo $this->Form->control('topic');
    echo $this->Form->control('introduction', ['label' => 'Lecture Introduction' ,'type' => 'textarea', 'class' => 'form-control tinymce_editor']);
    echo $this->Form->control('content', ['label' => 'Lecture Content', 'type' => 'textarea', 'class' => 'form-control tinymce_editor', 'rows' => 10]);
    echo $this->Form->control('summary', ['label' => 'Lecture Summary', 'type' => 'textarea', 'class' => 'form-control tinymce_editor']);
    echo $this->Form->control('exercise', ['label' => 'Exercises', 'type' => 'textarea', 'class' => 'form-control tinymce_editor']);
    echo $this->Form->control('sort_order', ['label' => 'Sort Order', 'class' => 'form-control']);
    ?>
</fieldset>
<?= $this->Form->button(__('Update'),['class' => 'btn btn-primary']) ?>
<?= $this->Form->end() ?>


<?= $this->Plugins->script('tinymice/tinymce.min.js') ?>
<script>tinymce.init({
        selector:'.tinymce_editor',
        images_dataimg_filter: function(img) {
            return img.hasAttribute('internal-blob');
        },
        height: 200,
        theme: 'modern',
        plugins: [
            'advlist autolink lists link image jbimages charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
        ],
        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  jbimages',
        toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
        image_advtab: true,
        templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
        ],
        /*content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ]*/
    });
</script>
