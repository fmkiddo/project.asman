<?php

my_div_open(8, array ('class' => 'card shadow mb-4'));
my_div_open(9, array ('class' => 'card-header py-3 d-flex flex-row align-items-center justify-content-between'));
my_inline_tag('h5', isset ($text) ? '' : 'Daftar Grup Pengguna', 10, array ('class' => 'm-0 font-weight-bold text-primary'));
my_div_close(9);    
my_div_open(9, array ('class' => 'card-body'));
my_div_open(10, array('class' => 'row'));
my_div_open(11, array ('class' => 'col-xl-3 col-lg-4 col-md-5 col-sm-12 col-xs-12'));
my_div_open(12, array ('class' => 'card mb-4'));
my_div_open(13, array ('class' => 'card-header py-3 d-flex flex-row align-items-center justify-content-between'));
my_inline_tag('h5', isset ($text) ? '' : 'Grup', 14, array ('class' => 'm-0 font-weight-bold text-primary'));
my_tag_open('button', 14, array ('class' => 'btn btn-secondary btn-icon-split', 'type' => 'button', 'name' => 'btn-add-group'));
my_tag_open('span', 15, array ('class' => 'icon text-white-50'));
my_inline_tag('i', '', 15, array ('class' => 'fas fa-plus-circle fa-fw'));
my_tag_close('span', 15);
my_inline_tag('span', isset ($text) ? '' : 'Tambah', 15, array ('class' => 'text'));
my_tag_close('button', 14);
my_div_close(13);
my_div_open(13, array ('class' => 'list-group list-group-flush'));
if (isset ($my_usergroups)) 
    foreach ($my_usergroups as $groups) {
        my_input_tag('radio', array ('name' => 'group-select', 'value' => $groups['idx'], 'id' => 'group-select-' . $groups['idx'], 'label' => $groups['name']), 14);
        my_inline_tag('label', $groups['name'], 14, array ('for' => 'group-select-' . $groups['idx'], 'class' => 'list-group-item'));
    }
my_div_close(13);
my_div_close(12);
my_div_close(11);

my_div_open(11, array ('class' => 'col-xl-9 col-lg-8 col-md-7 col-sm-12 col-xs-12'));
my_div_open(12, array ('class' => 'card mb-4'));
my_div_open(13, array ('class' => 'card-header py-3 d-flex flex-row align-items-center justify-content-between'));
my_inline_tag('h5', isset ($text) ? '' : 'Grup Pengguna Baru', 14, array ('class' => 'm-0 font-weight-bold text-primary'));
my_div_open(14, array ('id' => 'btn-groups'));
my_tag_open('button', 15, array ('class' => 'btn btn-secondary btn-icon-split', 'name' => 'btn-save-groups', 'type' => 'button', 'disabled' => 'disabled'));
my_tag_open('span', 16, array ('class' => 'icon text-white-50'));
my_inline_tag('i', '', 17, array ('class' => 'fas fa-save fa-fw'));
my_tag_close('span', 16);
my_inline_tag('span', isset ($text) ? '' : 'Simpan', 16, array ('class' => 'text'));
my_tag_close('button', 15);
my_div_close(14);
my_div_close(13);

my_tag_open('form', 13, array ('role' => 'form', 'id' => 'form-new-groups'));
my_div_open(14, array ('class' => 'card-body collapsible', 'id' => 'group-name'));
my_div_open(15, array ('class' => 'row'));
my_div_open(16, array ('class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'));
my_div_open(17, array ('class' => 'form-group'));
my_inline_tag('label', isset ($text) ? '' : 'Grup Pengguna Baru:', 18, array ('for' => 'new-groups-name'));
my_div_open(18, array ('class' => 'input-group'));
my_input_tag('text', array ('class' => 'form-control', 'name' => 'new-groups-name', 'placeholder' => isset ($text) ? '' : 'mis: Administrator, User, Standard User'), 19, true);
my_div_close(18);
my_div_close(17);
my_div_close(16);
my_div_close(15);

my_div_close(14);

if (isset ($my_systemmodules)) {
    my_div_open(14, array ('class' => 'list-group list-group-flush'));
    foreach ($my_systemmodules as $module) {
        my_input_tag('checkbox', array ('name' => 'module-select-' . $module['idx'], 'value' => $module['idx'], 'id' => 'module-select-' . $module['idx'], 'label' => $module['name']), 15);
        my_inline_tag('label', $module['name'], 15, array ('class' => 'list-group-item', 'for' => 'module-select-' . $module['idx']));
    }
    my_div_close(14);
}

my_tag_close('form', 13);

my_div_open(13, array ('class' => 'card-footer text-right collapsible'));
my_tag_open('button', 14, array ('type' => 'button', 'name' => 'btn-cancel-group', 'class' => 'btn btn-secondary btn-icon-split'));
my_tag_open('span', 15, array ('class' => 'icon text-white-50'));
my_inline_tag('i', '', 16, array ('class' => 'fas fa-times fa-fw'));
my_tag_close('span', 15);
my_inline_tag('span', isset ($text) ? '' : 'Batal', 15, array ('class' => 'text'));
my_tag_close('button', 14);
my_div_close(13);

my_div_close(12);
my_div_close(11);

my_div_close(10);
my_div_close(9);
my_div_close(8);  