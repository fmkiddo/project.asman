<?php

my_div_open(6, array ('class' => 'row'));
my_div_open(7, array ('class' => 'col-xl-2 col-lg-3 col-md-4 col-sm-12 col-xs-12'));
my_div_open(8, array ('class' => 'list-group'));
my_tag_open('button', 9, array ('type' => 'button', 'class' => 'btn btn-secondary', 'name' => 'btn-new-user'));
my_tag_open('span', 10, array ('class' => 'icon text-white-50'));
my_inline_tag('i', '', 11, array ('class' => 'fas fa-plus fa-fw'));
my_tag_close('span', 10);
my_inline_tag('span', isset ($text) ? '' : 'Tambah', 10, array ('class' => 'text'));
my_tag_close('button', 9);
my_div_close(8);
my_div_close(7);

my_div_open(7, array ('class' => 'col-xl-10 col-lg-9 col-md-8 col-sm-12 col-xs-12'));

my_div_open(8, array ('id' => 'form-section', 'class' => 'collapsible'));

my_div_open(9, array ('class' => 'card shadow mb-4'));

my_div_open(10, array ('class' => 'card-header'));
my_inline_tag('h5', isset ($text) ? '' : 'Buat User Baru', 11, array ('class' => 'm-0 font-weight-bold text-primary'));
my_div_close(10);

my_div_open(10, array ('class' => 'card-body'));

my_tag_open('form', 11, array ('role' => 'form', 'id' => 'form-new-user'));

my_div_open(12, array ('class' => 'row'));
my_div_open(13, array ('class' => 'col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'));

my_div_open(14, array ('class' => 'form-group'));
my_inline_tag('label', isset ($text) ? '' : 'Nama User:', 15, array ('for' => 'new-username'));
my_div_open(15, array ('class' => 'input-group'));
my_div_open(16, array ('class' => 'input-group-prepend'));
my_tag_open('span', 17, array ('class' => 'input-group-text'));
my_inline_tag('i', '', 18, array ('class' => 'fas fa-user fa-fw'));
my_tag_close('span', 17);
my_div_close(16);
my_input_tag('text', array ('class' => 'form-control', 'name' => 'new-username'), 16, true);
my_div_close(15);
my_div_close(14);

my_div_close(13);

my_div_open(13, array ('class' => 'col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'));
my_div_open(14, array ('class' => 'form-group'));
my_inline_tag('label', isset ($text) ? '' : 'Email:', 15, array ('for' => 'user-email'));
my_div_open(15, array ('class' => 'input-group'));
my_div_open(16, array ('class' => 'input-group-prepend'));
my_tag_open('span', 17, array ('class' => 'input-group-text'));
my_inline_tag('i', '', 18, array ('class' => 'fas fa-envelope-open fa-fw'));
my_tag_close('span', 17);
my_div_close(16);
my_input_tag('email', array ('class' => 'form-control', 'name' => 'user-email'), 16, true);
my_div_close(15);
my_div_close(14);
my_div_close(13);

my_div_open(13, array ('class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'));
my_div_open(14, array ('class' => 'form-group'));
my_inline_tag('label', isset ($text) ? '' : 'Grup Pengguna:', 15, array ('for' => 'user-group'));
my_div_open(15, array ('class' => 'input-group'));
my_div_open(16, array ('class' => 'input-group-prepend'));
my_tag_open('span', 17, array ('class' => 'input-group-text'));
my_inline_tag('i', '', 18, array ('class' => 'fas fa-users fa-fw'));
my_tag_close('span', 17);
my_div_close(16);
my_select_open(array ('name' => 'user-group', 'class' => 'form-control'), 16, true);
my_option_tag(17, '', isset ($text) ? '' : '--- Pilih Grup Pengguna ---', array ('selected' => 'selected'), false);

if (isset ($group_options))
    foreach ($group_options as $option)
        my_option_tag(17, $option['code'], $option['name']);
        
my_select_close(16);
my_div_close(15);
my_div_close(14);
my_div_close(13);

my_div_open(13, array ('class' => 'col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'));
my_div_open(14, array ('class' => 'form-group'));
my_inline_tag('label', isset ($text) ? '' : 'Kata Sandi:', 15, array ('for' => 'password'));
my_div_open(15, array ('class' => 'input-group'));
my_div_open(16, array ('class' => 'input-group-prepend'));
my_tag_open('span', 17, array ('class' => 'input-group-text'));
my_inline_tag('i', '', 18, array ('class' => 'fas fa-lock fa-fw'));
my_tag_close('span', 17);
my_div_close(16);
my_input_tag('password', array ('class' => 'form-control', 'name' => 'password'), 16, true);
my_div_close(15);
my_div_close(14);
my_div_close(13);

my_div_open(13, array ('class' => 'col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'));
my_div_open(14, array ('class' => 'form-group'));
my_inline_tag('label', isset ($text) ? '' : 'Konfirmasi Kata Sandi:', 15);
my_div_open(15, array ('class' => 'input-group'));
my_div_open(16, array ('class' => 'input-group-prepend'));
my_tag_open('span', 17, array ('class' => 'input-group-text'));
my_inline_tag('i', '', 18, array ('class' => 'fas fa-lock fa-fw'));
my_tag_close('span', 17);
my_div_close(16);
my_input_tag('password', array ('class' => 'form-control', 'name' => 'confirm-password'), 16, true);
my_div_close(15);
my_div_close(14);
my_div_close(13);

my_div_close(12);

my_tag_close('form', 11);

my_div_close(10);

my_div_open(10, array ('class' => 'card-footer'));

my_div_open(11, array ('class' => 'text-right'));
my_tag_open('button', 12, array ('class' => 'btn btn-secondary btn-icon-split', 'type' => 'button', 'name' => 'btn-cancel'));
my_tag_open('span', 13, array ('class' => 'icon text-white-50'));
my_inline_tag('i', '', 14, array ('class' => 'fas fa-ban fa-fw'));
my_tag_close('span', 13);
my_inline_tag('span', isset ($text) ? '' : 'Batal', 13, array ('class' => 'text'));
my_tag_close('button', 12);

my_tag_open('button', 12, array ('class' => 'btn btn-secondary btn-icon-split', 'type' => 'button', 'name' => 'btn-submit'));
my_tag_open('span', 13, array ('class' => 'icon text-white-50'));
my_inline_tag('i', '', 14, array ('class' => 'fas fa-check fa-fw'));
my_tag_close('span', 13);
my_inline_tag('span', isset ($text) ? '' : 'Simpan', 13, array ('class' => 'text'));
my_tag_close('button', 12);
my_div_close(11);

my_div_close(10);

my_div_close(9);

my_div_close(8);

my_div_open(8, array ('id' => 'data-section'));

my_div_open(9, array ('class' => 'card shadow mb-4'));
my_div_open(10, array ('class' => 'card-header'));
my_inline_tag('h5', isset ($text) ? '' : 'Data Pengguna', 11, array ('class' => 'm-0 font-weight-bold text-primary'));
my_div_close(10);

my_div_open(10, array ('class' => 'card-body'));
my_div_open(11, array ('class' => 'row'));
my_div_open(12, array ('class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'));
my_tag_open('table', 13, array ('class' => 'table table-striped table-hover', 'id' => 'dataTable-users'));
my_tag_open('thead', 14);
my_tag_open('tr', 15);
if (isset ($table_header)) 
    foreach ($table_header as $th) 
        my_inline_tag('th', $th, 16, array ('class' => 'text-center'));

my_tag_close('tr', 15);
my_tag_close('thead', 14);

my_tag_open('tbody', 14);

if (isset ($table_data)) {
    foreach ($table_data as $data) {
        my_tag_open('tr', 15);
        
        foreach ($data as $v) 
            my_inline_tag('td', $v, 16);
        
        my_tag_close('tr', 15);
    }
}

my_tag_close('tbody', 14);

my_tag_close('table', 13);
my_div_close(12);
my_div_close(11);
my_div_close(10);
my_div_close(9);

my_div_close(8);

my_div_close(7);
my_div_close(6);