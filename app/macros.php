<?php

Form::macro('Tab', function($label,$index,$errors,$rules=array(),$class="")
{
    $error_class= "";
    $arr=$errors->getMessages();
    for($i=0; $i<count($arr);$i++)
    {
        $arr_rules = array_values($rules);
        if(isset($arr_rules[$i]))
        {
            if(in_array($arr_rules[$i],array_keys($arr)))
            {
                $error_class='validation_error';break;
            }
        }
    }
    $html="<li class='$class'>";
    $html .="<a class='$error_class' href='#tab$index' data-toggle='tab'>";
    $html .= $label."</a></li>";
    
    return $html;
});

Form::macro('TextBox', function($label,$name,$errors,$width='80%') {

    $msg = $errors->getMessages();
    $error_class = (isset($msg[$name]))?"error":"";
    $value = Input::old($name);
    $html = '<span class="input-group-addon">'.$label.'</span>';
    $html .= Form::text($name, $value ,array('id' => $name,'class' => "form-control $error_class",'style' => "width:$width") );
    if(isset($msg[$name])) $html .= "<label class='$error_class'>".$errors->first($name, ':message').'</label>';
    return $html;
});


Form::macro('RichTextBox', function($label,$name,$errors,$value=null) {
    $value =  empty($value)?Input::old($name):$value;
    //echo $name;
    //var_dump($value);die;
    $html = "";
    $html .= Form::label($name, $label, array('class' => 'labelbox'));
    if(!isset($errors->$name)) $html .= "<span class='validation_error'>".$errors->first($name, '<li>:message</li>')."</span>";
    $html .= "<textarea id='$name' name='$name'>$value</textarea>";
    return $html;
});



Form::macro('SelectModel', function($label,$name,$model,$errors,$value=null,$width='200px;') {

    $msg = $errors->getMessages();
    $error_class = (isset($msg[$name]))?"error":"";
    $value = empty($value)?Input::old($name):$value;
    $values = \App\Utils\ListUtil::GetSelectList($model);
    $html = "";
    $html = '<span class="input-group-addon">'.$label.'</span>';
    if(isset($msg[$name])) $html .= "<label class='$error_class'>".$errors->first($name, ':message').'</label>';
    $html .= Form::select($name, $values,$value,array('class' => "form-control $error_class",'style' => "width:$width") );
    return $html;
});

Form::macro('HiddenBox', function($name,$value=null) {

    $value =  empty($value)?Input::old($name):$value;
    $html = "";
    $html .= Form::hidden($name, $value ,array('id' => $name) );
    return $html;
});

Form::macro('LabelBox', function($label,$value,$width='80%') {

    $html = "";
    $html .= "<span class='labelbox'>$label : </span>";
    $html .= "<b class='labelbox' style='width:$width'>$value</b>";
 
    return $html;
});