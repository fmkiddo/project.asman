<?php

my_div_open(6, array ('class' => 'card shadow mb-4'));
my_div_open(7, array ('class' => 'card-header py-3 d-flex flex-row align-items-center justify-content-between'));
my_inline_tag('h5', isset ($text) ? '' : 'Daftar Status Aset', 8, array ('class' => 'm-0 font-weight-bold text-primary'));
my_div_close(7);

my_div_open(7, array ('class' => 'card-body'));

my_div_open(8, array ('class' => 'row'));
my_div_open(9, array ('class' => 'col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12'));

my_div_open(10, array ('class' => 'card'));
my_div_open(11, array ('class' => 'card-header py-3 d-flex flex-row align-items-center justify-content-between'));
my_inline_tag('h5', isset ($text) ? '' : 'Status Aset', 12, array ('class' => 'm-0 font-weight-bold text-primary'));

my_tag_open('button', 12, array ('class' => 'btn btn-primary btn-icon-split', 'name' => 'btn-add-status', 'type' => 'button'));
my_tag_open('span', 13, array ('class' => 'icon text-white-50'));
my_inline_tag('i', '', 14, array ('class' => 'fas fa-plus fa-fw'));
my_tag_close('span',13);
my_inline_tag('span', isset ($text) ? '' : 'Buat Status', 13, array ('class' => 'text'));
my_tag_close('button', 12);
my_div_close(11);

my_div_open(11, array ('class' => 'list-group list-group-flush'));
if (isset ($my_statuses)) {
    foreach ($my_statuses as $status) {
        my_input_tag('radio', 
            array (
                'name' => 'status-select', 
                'value' => $status['idx'], 
                'id' => 'status-select-' . $status['idx'], 
                'label' => $status['name'], 
                'data-color' => $status['color'], 
                'data-loanable' => $status['loanable'] == 1 ? 'true' : 'false', 
                'data-archived' => $status['archive'] == 1 ?  'true' : 'false'
            ), 12);
        my_inline_tag('label', $status['name'], 12, array ('for' => 'status-select-' . $status['idx'], 'class' => 'list-group-item'));
    }
}
my_div_close(11);
my_div_close(10);
my_div_close(9);

my_div_open(9, array ('class' => 'col-xl-8 col-lg-8 col-md-6 col-sm-12 col-xs-12'));

my_div_open(10, array ('class' => 'card'));
my_div_open(11, array ('class' => 'card-body'));

my_tag_open('form', 12, array ('role' => 'form', 'id' => 'form-new-asset-status'));
my_div_open(13, array ('class' => 'row'));
my_div_open(14, array ('class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'));
my_div_open(15, array ('class' => 'form-group'));
my_inline_tag('label', isset ($text) ? '' : 'Label Status:', 16, array ('for' => 'new-status-name'));
my_div_open(16, array ('class' => 'input-group'));
my_input_tag('hidden', array ('value' => 'true', 'name' => 'new-status'), 17, true);
my_input_tag('text', array ('class' => 'form-control', 'name' => 'new-status-name'), 17, true);
my_div_close(16);
my_div_close(15);
my_div_close(14);
my_div_close(13);

my_div_open(13, array ('class' => 'row'));
my_div_open(14, array ('class' => 'col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12'));
my_div_open(15, array ('class' => 'form-group'));
my_inline_tag('label', isset ($text) ? '' : 'Warna:', 16, array ('for' => 'new-status-color'));
my_div_open(16, array ('class' => 'input-group'));
my_input_tag('text', array ('class' => 'form-control jscolor {closable:true, closeText:\'' . (isset ($text) ? '' : 'Tutup') . '\'}', 'name' => 'new-status-color'), 17, false);
my_div_close(16);
my_div_close(15);
my_div_close(14);
my_div_open(14, array ('class' => 'col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12'));
my_div_open(15, array ('class' => 'form-group'));
my_inline_tag('label', isset ($text) ? '' : 'Dipinjamkan:', 16);
my_div_open(16, array ('class' => 'input-group'));
my_div_open(17, array ('class' => 'checkbox'));
my_tag_open('label', 18, array ('for' => 'new-status-loanable'));
my_input_tag('checkbox', array ('name' => 'new-status-loanable', 'checked' => 'checked'), 19, true);
echo dom_shift(19) . (isset ($text) ? '' : 'Bisa / Tidak Bisa') . "\n";
my_tag_close('label', 18);
my_div_close(17);
my_div_close(16);
my_div_close(15);
my_div_close(14);
my_div_open(14, array ('class' => 'col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12'));
my_div_open(15, array ('class' => 'form-group'));
my_inline_tag('label', isset ($text) ? '' : 'Diarsipkan:', 16);
my_div_open(16, array ('class' => 'input-group'));
my_div_open(17, array ('class' => 'checkbox'));
my_tag_open('label', 18, array ('for' => 'new-status-archived'));
my_input_tag('checkbox', array ('name' => 'new-status-archived'), 19, true);
echo dom_shift(19) . (isset ($text) ? '' : 'Ya / Tidak') . "\n";
my_tag_close('label', 18);
my_div_close(17);
my_div_close(16);
my_div_close(15);
my_div_close(14);
my_div_close(13);
my_tag_close('form', 12);

my_div_close(11);

my_div_open(11, array ('class' => 'card-footer'));
my_div_open(12, array ('class' => 'text-right'));
my_tag_open('button', 13, array ('type' => 'button', 'name' => 'btn-save-status', 'class' => 'btn btn-primary btn-icon-split'));
my_tag_open('span', 14, array ('class' => 'icon text-white-50'));
my_inline_tag('i', '', 15, array ('class' => 'fas fa-save fa-fw'));
my_tag_close('span', 14);
my_inline_tag('span', isset ($text) ? '' : 'Simpan', 15, array ('class' => 'text'));
my_tag_close('button', 13);
my_tag_open('button', 13, array ('type' => 'button', 'name' => 'btn-reset-status', 'class' => 'btn btn-primary btn-icon-split'));
my_tag_open('span', 14, array ('class' => 'icon text-white-50'));
my_inline_tag('i', '', 15, array ('class' => 'fas fa-undo fa-fw'));
my_tag_close('span', 14);
my_inline_tag('span', isset ($text) ? '' : 'Perbarui', 14, array ('class' => 'text'));
my_tag_close('button', 13);
my_div_close(12);
my_div_close(11);
my_div_close(10);

my_div_close(9);
my_div_close(8);

my_div_close(7);

my_div_open(7, array ('class' => 'card-footer'));
my_div_open(8, array ('class' => 'text-right'));
my_div_close(8);
my_div_close(7);
my_div_close(6);

my_source(6, 'script', base_url('webassets/vendor/jscolor/jscolor.js'), 'defer');