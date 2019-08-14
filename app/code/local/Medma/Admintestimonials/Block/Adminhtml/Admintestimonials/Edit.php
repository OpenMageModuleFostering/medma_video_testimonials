<?php

class Medma_Admintestimonials_Block_Adminhtml_Admintestimonials_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'admintestimonials';
        $this->_controller = 'adminhtml_admintestimonials';
        
        $this->_updateButton('save', 'label', Mage::helper('admintestimonials')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('admintestimonials')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);
		$required = '<span class="required">*</span>';
		$removeButton = '';
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('admintestimonials_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'admintestimonials_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'admintestimonials_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
			function addNewDiv()
			{
				filecount = document.getElementById('video_link_length').value;
				if(filecount == '')
					filecount =1;
				
				
				filecount++;
			
				video_url_txtbox = 'video_url_'+filecount;
				
				position_txtbox = 'position_'+filecount;

				status_txtbox = 'status_'+filecount;

				var tbody = document.getElementById('edit_form').getElementsByTagName('tbody')[0];

				var row = document.createElement('tr');
				row.setAttribute('id', 'video_row'+filecount);
				var data1 = document.createElement('td');
				data1.setAttribute('class','label');
				data1.innerHTML='Youtube Video Url $required';			
			
				var data2 = document.createElement('td');
				data2.setAttribute('class','value');
			
				var textbox = document.createElement('input');

				textbox.setAttribute('type', 'text');
				textbox.setAttribute('name', video_url_txtbox);
				textbox.setAttribute('class', 'input-text required-entry');
				textbox.setAttribute('value', '');
	   			
				data2.appendChild(textbox);

				row.appendChild(data1);
				row.appendChild(data2);
				tbody.appendChild(row);

				var row = document.createElement('tr');
				row.setAttribute('id', 'position_row'+filecount);
				var data1 = document.createElement('td');
				data1.setAttribute('class','label');
				data1.innerHTML='Position $required';			

				var data2 = document.createElement('td');
				data2.setAttribute('class','value');

				var textbox = document.createElement('input');

				textbox.setAttribute('type', 'text');
				textbox.setAttribute('name', position_txtbox);
				textbox.setAttribute('class', 'input-text required-entry');
				textbox.setAttribute('value', '');

				data2.appendChild(textbox);

				row.appendChild(data1);
				row.appendChild(data2);
				tbody.appendChild(row);

				var row = document.createElement('tr');
				row.setAttribute('id', 'status_row'+filecount);
				var data1 = document.createElement('td');
				data1.setAttribute('class','label');
				data1.innerHTML='Status ';			

				var data2 = document.createElement('td');
				data2.setAttribute('class','value');

				var textbox = document.createElement('select');

				textbox.setAttribute('type', 'select');
				textbox.setAttribute('name', status_txtbox);
				textbox.setAttribute('id', status_txtbox);
				textbox.setAttribute('class', '');
				textbox.setAttribute('value', '');

				data2.appendChild(textbox);

				var data3 = document.createElement('td');
var button = document.createElement('button');

				button.setAttribute('type', 'button');
				button.setAttribute('name', filecount);
				button.setAttribute('id', filecount);
				button.setAttribute('class', 'scalable delete');
				button.setAttribute('onclick', 'removevideodivs(this.id)');
				button.innerHTML = 'Remove';
				data3.appendChild(button);
				row.appendChild(data1);
				row.appendChild(data2);
				row.appendChild(data3);
				tbody.appendChild(row);

				var s= document.getElementById(status_txtbox);
				s.options[s.options.length]= new Option('Enabled', '1');
				s.options[s.options.length]= new Option('Disabled', '2');

				document.getElementById('video_link_length').value=filecount;
			
			}
			function removevideodivs(id)
			{
				var tbody = document.getElementById('edit_form').getElementsByTagName('tbody')[0];
				var tr = document.getElementById('video_row'+id);

				tbody.removeChild(tr);

				var tr = document.getElementById('status_row'+id);

				tbody.removeChild(tr);

				var tr = document.getElementById('position_row'+id);

				tbody.removeChild(tr);
			}
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('admintestimonials_data') && Mage::registry('admintestimonials_data')->getId() ) {
			$category_id = $this->htmlEscape(Mage::registry('admintestimonials_data')->getCategoryId());
			$loadedCategory = Mage::getModel('catalog/category')->load($category_id);
			//$loadedCategory->getName();
            return Mage::helper('admintestimonials')->__("Edit Item '%s'", $loadedCategory->getName());
        } else {
            return Mage::helper('admintestimonials')->__('Add Item');
        }
    }
}
