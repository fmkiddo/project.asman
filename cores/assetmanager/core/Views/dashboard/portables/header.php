<!DOCTYPE html>
<html>
<head> 
	<style>
	body {
		font-family: "Times New Roman", Times, serif;
		font-size: 11pt;
		min-height: 100%;
	}
	
	.container-fluid {
		width: 100%;
		padding: 0.075em;
	}
	
	p {
		margin: 0.5em 0;
		padding: 0;
	}
	
	.bold {
		font-weight: bold;
	}
	
	.small {
		font-size: 8pt;
	}
	
	.bordered {
		border: 0.5px solid #000;
		display: block;
	}
	
	.row {
		width: 100%;
		display: block;
	}
	
	.row:after {
		content: "";
		display: table;
		clear: both;
	}
	
	.col-1 {
		width: 10%;
	}
	
	.col-2 {
		width: 20%;
	}
	
	.col-3 {
		width: 30%;
	}
	
	.col-4 {
		width: 40%;
	}
	
	.col-5 {
		width: 50%;
	}
	
	.col-6 {
		width: 60%;
	}
	
	.col-7 {
		width: 70%;
	}
	
	.col-8 {
		width: 80%;
	}
	
	.col-9 {
		width: 90%;
	}
	
	.col-10 {
		width: 100%;
	}
	
	.col-1, .col-2, .col-3, .col-4, .col-5, 
	.col-6, .col-7, .col-8, .col-9, .col-10 {
		margin: 0 0.25em;
		float: left;
	}
	
	table.table-bordered {
		border: 0.5px solid #000;
	}
	
	td.colon {
		text-align: center;
		width: 3%;
		white-space: nowrap;
	}
	
	.documents {
		text-align: justify;
	}
	
	.documents .documents-header {
		text-align: right;
	}
	
	.documents .documents-header .documents-title {
		margin: 0 2em 0 0;
	}
	
	.documents .documents-header:after {
		display: block;
		border-bottom: 1px solid #000;
	}
	
	.documents .documents-body {
		margin: 0.5em 0 0;
		display: block;
	}
	
	.document-header table.table {
		font-size: 9pt;
		table-layout: auto;
		width: 100%;
		border-collapse: collapse;
		font-weight: bold;
		padding: 0;
	}
	
	.document-header table.table thead {
		display: none;
	}
	
	.document-header table.table.table-invoice td {
		vertical-align: text-top;
	}
	
	.document-header table.table.table-invoice td:first-child {
		width: 5%;
		white-space: nowrap;
	}
	
	.document-body {
		margin-top: 1.15em;
		display: block;
		padding-bottom: 25px;
		height: auto;
	}
	
	.document-body table.table {
		font-size: 9pt;
		table-layout: fixed;
		width: 100%;
		border-collapse: collapse;
		font-weight: bold;
		padding: 0;
	}
	
	.document-body table.table.table-invoice-detailed th {
		border: 0.5px solid black;
	}
	
	.document-body table.table.table-invoice-detailed th:first-child {
		width: 5%;
		white-space: nowrap;
	}
	
	.document-body table.table.table-invoice-detailed th:nth-child(2) {
		width: 12%;
		white-space: nowrap;
	}
	
	.document-body table.table.table-invoice-detailed th:nth-child(3) {
		width: 55%;
		white-space: nowrap;
	}
	
	.document-body table.table.table-invoice-detailed th:last-child {
		width: 7%;
		white-space: nowrap;
	}
	
	.document-body table.table.table-invoice-detailed td {
		vertical-align: text-top;
		padding: 5px;
		border-left: 0.5px solid #000;
		border-right: 0.5px solid #000;
	}
	
	.document-body table.table.table-invoice-detailed td:last-child {
		text-align: center;
	}
	
	.document-footer {
		bottom: 0;
	}
	
	.document-footer table.table {
		width: 100%;
		table-layout: fixed;
		min-height: 30%;
		border-collapse: collapse;
	}
	
	.document-footer table.table.table-bordered th {
		padding: 5px 0;
		border: 0.5px solid #000;
	}
	
	.document-footer table.table.table-bordered td {
		height: 70px;
		border: 0.5px solid #000;
	}
	</style>
</head>
<body>
