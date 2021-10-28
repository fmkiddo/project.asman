<?php

my_div_open(6, array ('class' => 'row'));
my_div_open(7, array ('class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'));
my_div_open(8, array ('class' => 'card shadow mb-4'));
my_div_open(9, array ('class' => 'card-header py-3 d-flex flex-row align-items-center justify-content-between'));
my_inline_tag('h5', isset ($text) ? '' : 'Profil Pengguna', 10, array ('class' => 'm-0 font-weight-bold text-primary'));
my_tag_open('button', 10, array ('type' => 'button', 'name' => 'btn-update-profile', 'class' => 'btn btn-secondary btn-icon-split'));
my_tag_open('span', 11, array ('class' => 'icon text-white-50'));
my_inline_tag('i', '', 12, array ('class' => 'fas fa-save fa-fw'));
my_tag_close('span', 11);
my_inline_tag('span', isset ($text) ? '' : 'Simpan', 11, array ('class' => 'text'));
my_tag_close('button', 10);
my_div_close(9);

my_div_open(9, array ('class' => 'card-body'));
my_tag_open('form', 10, array ('role' => 'form', 'id' => 'form-profile'));

my_div_open(11, array ('class' => 'row'));
my_div_open(12, array ('class' => 'col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12'));
my_div_open(13, array ('class' => 'card mb-4'));
my_div_open(14, array ('class' => 'card-body'));
if (isset ($my_image)) {
    
} else 
    my_img('100%', '100%', '../webassets/img/avatar_blank_human_face_contact_user_app-1024x1024.png');
my_div_close(14);
my_div_open(14, array ('class' => 'card-footer text-right'));
my_div_open(15, array ('class' => 'collapsible'));
my_input_tag('file', array ('name' => 'user-profile-photo', 'accept' => 'image/png,image/jpeg'), 16, TRUE);
my_div_close(15);
my_tag_open('button', 15, array ('type' => 'button', 'name' => 'btn-pick-image', 'class' => 'btn btn-secondary btn-icon-split'));
my_tag_open('span', 16, array ('class' => 'icon text-white-50'));
my_inline_tag('i', '', 17, array ('class' => 'fas fa-folder-open fa-fw'));
my_tag_close('span', 16);
my_inline_tag('span', isset ($text) ? '' : 'Pilih', 16, array ('class' => 'text'));
my_tag_close('button', 15);

my_div_close(14);
my_div_close(13);
my_div_close(12);

my_div_open(12, array ('class' => 'col-xl-8 col-lg-4 col-md-4 col-sm-12 col-xs-12'));
my_div_open(13, array ('class' => 'form-group'));
my_inline_tag('label', isset ($text) ? '' : 'Nama Depan:', 14, array ('for' => 'profile-first-name'));
my_div_open(14, array ('class' => 'input-group'));
my_input_tag('text', array ('name' => 'profile-first-name', 'class' => 'form-control'), 15, TRUE);
my_div_close(14);
my_div_close(13);

my_div_open(13, array ('class' => 'form-group'));
my_inline_tag('label', isset ($text) ? '' : 'Nama Tengah:', 14, array ('for' => 'profile-middle-name'));
my_div_open(14, array ('class' => 'input-group'));
my_input_tag('text', array ('name' => 'profile-middle-name', 'class' => 'form-control'), 15, true);
my_div_close(14);
my_div_close(13);

my_div_open(13, array ('class' => 'form-group'));
my_inline_tag('label', isset ($text) ? '' : 'Nama Belakang:', 14, array ('for' => 'profile-last-name'));
my_div_open(14, array ('class' => 'input-group'));
my_input_tag('text', array ('name' => 'profile-last-name', 'class' => 'form-control'), 15, true);
my_div_close(14);
my_div_close(13);

my_div_open(13, array ('class' => 'form-group'));
my_inline_tag('label', isset ($text) ? '' : 'Alamat:', 14, array ('for' => 'profile-address'));
my_div_open(14, array ('class' => 'input-group'));
my_inline_tag('textarea', '', 15, array ('class' => 'form-control', 'rows' => '3', 'name' => 'profile-address', 'required'));
my_div_close(14);
my_div_close(13);

my_div_open(13, array ('class' => 'form-group'));
my_inline_tag('label', isset ($text) ? '' : 'No. Telepon:', 14, array ('for' => 'profile-phone'));
my_div_open(14, array ('class' => 'input-group'));
my_input_tag('text', array ('class' => 'form-control', 'name' => 'profile-phone'), 15, TRUE);
my_div_close(14);
my_div_close(13);

my_div_open(13, array ('class' => 'form-group'));
my_inline_tag('label', isset ($text) ? '' : 'Email:', 14, array ('for' => 'profile-email'));
my_div_open(14, array ('class' => 'input-group'));
my_input_tag('email', array ('class' => 'form-control', 'name' => 'profile-email'), 15, TRUE);
my_div_close(14);
my_div_close(13);
my_div_close(12);
my_div_close(11);

my_tag_close('form', 10);
my_div_close(9);

my_div_close(8);
my_div_close(7);
my_div_close(6); 