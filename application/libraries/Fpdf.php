<?php
// application/libraries/Fpdf.php
// Wrapper untuk FPDF agar bisa digunakan sebagai library CI

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'libraries/fpdf/fpdf.php';

class Fpdf extends FPDF
{
    // Bisa ditambah method custom jika perlu
}
