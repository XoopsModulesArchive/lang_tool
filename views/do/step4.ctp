<?php
echo $this->renderElement('navbar', array('step' => 4));
echo $form->create('Do', array('url' => array('controller' => 'do', 'action' => 'step5')));
echo $form->input('extension', array('type' => 'hidden', 'value' => $extension));
if($extension == 'php') {
    echo _MD_LANG_TOOL_INFILE.$_SESSION['lang_tool']['file'].'<br><table><tr><td>'.$_SESSION['lang_tool']['from'].'</td><td>copy</td><td>'.$_SESSION['lang_tool']['to'].'</td></tr>';
    $bgnum = 1;
    while(list($key, $val) = each($sourceLanguage)){
        if($bgnum%2==1)
        $bgcolor = '#CCCCFF';
        else
        $bgcolor = '#FFCCCC';
        $bgnum ++;
        echo '<tr bgcolor="'.$bgcolor.'"><td>'.nl2br(htmlentities($val, ENT_QUOTES, _CHARSET)).'</td>';
        echo '<td>';
        echo '<div id="src' . $key . '" style="display:none;">' . $val . '</div>';
        echo $html->link('=', '#', array('onClick' => 'xoops$(\'' . $key . '\').value=xoops$(\'src' . $key . '\').innerHTML; return false;')) . '</td><td>';
        $rows = (strlen($val) / 50) + 2;
        if(substr_count($val, chr(10))||strlen($val)>100) {
            if(isset($targetLanguage[$key])) {
                echo $form->input('Lang.' . $key, array('type' => 'textarea', 'rows' => $rows, 'cols' => 40,
                'id' => $key,
                'style' => 'border:1px solid #999999;font-size:10pt',
                'value' => stripslashes($targetLanguage[$key]),
                'label' => false));
            } else {
                echo $form->input('Lang.' . $key, array('type' => 'textarea', 'rows' => $rows, 'cols' => 40,
                'id' => $key,
                'style' => 'border:1px solid #999999;font-size:10pt',
                'value' => stripslashes($sourceLanguage[$key]),
                'label' => false));
            }
        } else if(isset($targetLanguage[$key])) {
            echo $form->input('Lang.' . $key, array('type' => 'text',
            'id' => $key,
            'value' => stripslashes($targetLanguage[$key]),
            'style' => 'border:1px solid #999999', 'label' => false, 'size' => 60));
        } else {
            echo $form->input('Lang.' . $key, array('type' => 'text',
            'value' => stripslashes($sourceLanguage[$key]),
            'style' => 'border:1px solid #999999', 'label' => false, 'size' => 60));
        }
        echo '</td></tr>';
    }
    echo '</table>';
} else {
    echo '<textarea id="source" name="data[Do][source]" rows="20" cols="80" readonly>'.$sourceString.'</textarea>';
    echo '<p><input type="button" value="==" onclick="this.form.target.value=this.form.source.value"> <input type="reset"></p>';
    echo '<textarea id="target" name="data[Do][target]" rows="20" cols="80">';
    if(isset($targetString)) {
        echo $targetString;
    }
    echo '</textarea>';
}
echo $form->end('Submit');