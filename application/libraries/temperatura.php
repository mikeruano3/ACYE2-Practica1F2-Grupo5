<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temperatura
{

    public function getValueOfTemp($humedad, $temperatura) {

		$arr_temp[90][30] = 89;
		$arr_temp[90][35] = 91;
		$arr_temp[90][40] = 92;
		$arr_temp[90][45] = 94;
		$arr_temp[90][50] = 96;
		$arr_temp[90][55] = 98;
		$arr_temp[90][60] = 100;
		$arr_temp[90][65] = 103;
		$arr_temp[90][70] = 106;
		$arr_temp[90][75] = 109;
		$arr_temp[90][80] = 112;
		$arr_temp[90][85] = 115;
		$arr_temp[90][90] = 119;

		$arr_temp[91][30] = 90;
		$arr_temp[91][35] = 92;
		$arr_temp[91][40] = 94;
		$arr_temp[91][45] = 96;
		$arr_temp[91][50] = 98;
		$arr_temp[91][55] = 100;
		$arr_temp[91][60] = 103;
		$arr_temp[91][65] = 106;
		$arr_temp[91][70] = 109;
		$arr_temp[91][75] = 112;
		$arr_temp[91][80] = 115;
		$arr_temp[91][85] = 119;
		$arr_temp[91][90] = 123;

		$arr_temp[92][30] = 92;
		$arr_temp[92][35] = 94;
		$arr_temp[92][40] = 96;
		$arr_temp[92][45] = 98;
		$arr_temp[92][50] = 100;
		$arr_temp[92][55] = 103;
		$arr_temp[92][60] = 105;
		$arr_temp[92][65] = 108;
		$arr_temp[92][70] = 112;
		$arr_temp[92][75] = 115;
		$arr_temp[92][80] = 119;
		$arr_temp[92][85] = 123;
		$arr_temp[92][90] = 128;

		$arr_temp[93][30] = 93;
		$arr_temp[93][35] = 95;
		$arr_temp[93][40] = 97;
		$arr_temp[93][45] = 100;
		$arr_temp[93][50] = 102;
		$arr_temp[93][55] = 105;
		$arr_temp[93][60] = 108;
		$arr_temp[93][65] = 111;
		$arr_temp[93][70] = 115;
		$arr_temp[93][75] = 119;
		$arr_temp[93][80] = 123;
		$arr_temp[93][85] = 127;
		$arr_temp[93][90] = 132;

		$arr_temp[94][30] = 95;
		$arr_temp[94][35] = 97;
		$arr_temp[94][40] = 99;
		$arr_temp[94][45] = 102;
		$arr_temp[94][50] = 104;
		$arr_temp[94][55] = 107;
		$arr_temp[94][60] = 111;
		$arr_temp[94][65] = 114;
		$arr_temp[94][70] = 118;
		$arr_temp[94][75] = 122;
		$arr_temp[94][80] = 127;
		$arr_temp[94][85] = 132;
		$arr_temp[94][90] = 137;

		$arr_temp[95][30] = 96;
		$arr_temp[95][35] = 98;
		$arr_temp[95][40] = 101;
		$arr_temp[95][45] = 104;
		$arr_temp[95][50] = 107;
		$arr_temp[95][55] = 110;
		$arr_temp[95][60] = 114;
		$arr_temp[95][65] = 117;
		$arr_temp[95][70] = 122;
		$arr_temp[95][75] = 126;
		$arr_temp[95][80] = 131;
		$arr_temp[95][85] = 136;
		$arr_temp[95][90] = 141;

		$arr_temp[96][30] = 98;
		$arr_temp[96][35] = 100;
		$arr_temp[96][40] = 103;
		$arr_temp[96][45] = 106;
		$arr_temp[96][50] = 109;
		$arr_temp[96][55] = 113;
		$arr_temp[96][60] = 116;
		$arr_temp[96][65] = 121;
		$arr_temp[96][70] = 125;
		$arr_temp[96][75] = 130;
		$arr_temp[96][80] = 135;
		$arr_temp[96][85] = 141;
		$arr_temp[96][90] = 146;

		$arr_temp[97][30] = 99;
		$arr_temp[97][35] = 102;
		$arr_temp[97][40] = 105;
		$arr_temp[97][45] = 108;
		$arr_temp[97][50] = 112;
		$arr_temp[97][55] = 115;
		$arr_temp[97][60] = 120;
		$arr_temp[97][65] = 124;
		$arr_temp[97][70] = 129;
		$arr_temp[97][75] = 134;
		$arr_temp[97][80] = 140;
		$arr_temp[97][85] = 145;
		$arr_temp[97][90] = 152;

		$arr_temp[98][30] = 101;
		$arr_temp[98][35] = 104;
		$arr_temp[98][40] = 107;
		$arr_temp[98][45] = 110;
		$arr_temp[98][50] = 114;
		$arr_temp[98][55] = 118;
		$arr_temp[98][60] = 123;
		$arr_temp[98][65] = 127;
		$arr_temp[98][70] = 133;
		$arr_temp[98][75] = 138;
		$arr_temp[98][80] = 144;
		$arr_temp[98][85] = 150;
		$arr_temp[98][90] = 157;

		$arr_temp[99][30] = 102;
		$arr_temp[99][35] = 106;
		$arr_temp[99][40] = 109;
		$arr_temp[99][45] = 113;
		$arr_temp[99][50] = 117;
		$arr_temp[99][55] = 121;
		$arr_temp[99][60] = 126;
		$arr_temp[99][65] = 131;
		$arr_temp[99][70] = 137;
		$arr_temp[99][75] = 143;
		$arr_temp[99][80] = 149;
		$arr_temp[99][85] = 155;
		$arr_temp[99][90] = 163;

		$arr_temp[100][30] = 104;
		$arr_temp[100][35] = 107;
		$arr_temp[100][40] = 111;
		$arr_temp[100][45] = 115;
		$arr_temp[100][50] = 119;
		$arr_temp[100][55] = 124;
		$arr_temp[100][60] = 129;
		$arr_temp[100][65] = 135;
		$arr_temp[100][70] = 141;
		$arr_temp[100][75] = 147;
		$arr_temp[100][80] = 151;
		$arr_temp[100][85] = 161;
		$arr_temp[100][90] = 168;

		$arr_temp[101][30] = 106;
		$arr_temp[101][35] = 109;
		$arr_temp[101][40] = 113;
		$arr_temp[101][45] = 118;
		$arr_temp[101][50] = 122;
		$arr_temp[101][55] = 127;
		$arr_temp[101][60] = 133;
		$arr_temp[101][65] = 139;
		$arr_temp[101][70] = 145;
		$arr_temp[101][75] = 152;
		$arr_temp[101][80] = 159;
		$arr_temp[101][85] = 166;
		$arr_temp[101][90] = 174;

		$arr_temp[102][30] = 108;
		$arr_temp[102][35] = 112;
		$arr_temp[102][40] = 116;
		$arr_temp[102][45] = 120;
		$arr_temp[102][50] = 125;
		$arr_temp[102][55] = 131;
		$arr_temp[102][60] = 136;
		$arr_temp[102][65] = 143;
		$arr_temp[102][70] = 149;
		$arr_temp[102][75] = 156;
		$arr_temp[102][80] = 164;
		$arr_temp[102][85] = 172;
		$arr_temp[102][90] = 180;

		$arr_temp[103][30] = 110;
		$arr_temp[103][35] = 114;
		$arr_temp[103][40] = 118;
		$arr_temp[103][45] = 123;
		$arr_temp[103][50] = 128;
		$arr_temp[103][55] = 134;
		$arr_temp[103][60] = 140;
		$arr_temp[103][65] = 147;
		$arr_temp[103][70] = 154;
		$arr_temp[103][75] = 161;
		$arr_temp[103][80] = 169;
		$arr_temp[103][85] = 178;
		$arr_temp[103][90] = 186;

		$arr_temp[104][30] = 112;
		$arr_temp[104][35] = 116;
		$arr_temp[104][40] = 121;
		$arr_temp[104][45] = 126;
		$arr_temp[104][50] = 131;
		$arr_temp[104][55] = 137;
		$arr_temp[104][60] = 144;
		$arr_temp[104][65] = 151;
		$arr_temp[104][70] = 158;
		$arr_temp[104][75] = 166;
		$arr_temp[104][80] = 175;
		$arr_temp[104][85] = 184;
		$arr_temp[104][90] = 193;

		$arr_temp[105][30] = 114;
		$arr_temp[105][35] = 118;
		$arr_temp[105][40] = 123;
		$arr_temp[105][45] = 129;
		$arr_temp[105][50] = 135;
		$arr_temp[105][55] = 141;
		$arr_temp[105][60] = 148;
		$arr_temp[105][65] = 155;
		$arr_temp[105][70] = 163;
		$arr_temp[105][75] = 171;
		$arr_temp[105][80] = 180;
		$arr_temp[105][85] = 190;
		$arr_temp[105][90] = 199;

        $humedad = $this->roundUpToAny($humedad);
        $temperatura = $this->roundUpToAny($temperatura);

        return $arr_temp[$humedad][$temperatura];

	}

    public function roundUpToAny($n, $x=5){
        return (round($n)%$x === 0) ? round($n) : round(($n+$x/2)/$x)*$x;
    }

}
