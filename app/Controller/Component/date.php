<?php
/**
 * This component have functions to manipulate dates.
 * @author pedro
 * @since 2010-02-03 09:24
 */
class DateComponent extends Object {
	/**
	 * Convert the date from the format YYYY-MM-DD to DD/MM/YYYY
	 * @param string $date
	 * @return string
	 */
	public function DBToRead($date) {
		list($year, $month, $day) = explode('-', $date);
		return $day.'/'.$month.'/'.$year;
	}
	/**
	 * Convert the date from the format DD/MM/YYYY to YYYY-MM-DD
	 * @param string $date
	 * @return string
	 */
	public function ReadToDB($date) {
		list($day, $month, $year) = explode('/', $date);
		return $year.'-'.$month.'-'.$day;
	}
	
	/**
	 * Subtrai dias de uma data
	 * 
	 * @param $data
	 * @param $days
	 * @param $format
	 * 
	 * @return string
	 */
	function sub ( $data , $days , $format = 'Y-m-d H:i:s') {
		
		$tmsp = $this->getTimestamp ( $data );
		
		return date ( $format , $tmsp - ( 3600 * 24 * $days ) );

	}
	
	/**
	 * Retorna o timestmp 
	 * @param  $date
	 * @param  $format
	 * @return 
	 */
	function getTimestamp ( $date , $format = null ) {
		
		$formats['us'][] = '([0-9]{4})-([0-9]{2})-([0-9]{2})'; // 2010-01-01
		$formats['us'][] = '([0-9]{4})-([0-9]{2})-([0-9]{2}) ([0-9]{2}):([0-9]{2}):([0-9]{2})';
		
		$formats['br'][] = '([0-9]{2})/([0-9]{2})/([0-9]{4})'; // 01/01/2010
		$formats['br'][] = '([0-9]{2})/([0-9]{2})/([0-9]{4}) ([0-9]{2}):([0-9]{2}):([0-9]{2})';
		
		$formats['br'][] = '([0-9]{2})/([0-9]{2})/([0-9]{2})'; // 01/01/10
		$formats['br'][] = '([0-9]{2})/([0-9]{2})/([0-9]{2}) ([0-9]{2}):([0-9]{2}):([0-9]{2})';
		
		
		foreach ( $formats  as $ctry=>$fmt ) {
			
			foreach ( $fmt as $er ) {
				
				if ( preg_match ( "%^$er$%" , $date , &$matchs) ) {
					
					// percorre o array e verifica se existe valor no formato especificado
					// para não dar erro de Offset no list abaixo !!! <sjunior>
					for ( $y = 0 ; $y < 7 ; $y++ ) {
						$matchs[$y] = isset ( $matchs[$y]) ? $matchs[$y] : 0 ;
					}
					
					switch ( $ctry ) {
						case "br" :
							list ( $null , $day , $month , $year , $hour , $minute , $second ) = $matchs ;
						break;
						case "us" :
							list ( $null , $year , $month , $day , $hour , $minute , $second ) = $matchs ;
						break;
					}
					
					$found = true;
					break;
					
				}
			}
		}
		
		if ( $found ) {
			return mktime ( $hour , $minute , $second , $month , $day , $year  );
		} else {
			trigger_error ( 'Formato de data não identificado' , E_WARNING );
		}
		
	}
	
	/**
	 * Formata data
	 * @param string $date
	 * @param $format
	 */
	function format ( $date , $format ='Y-m-d' ) {
		
		$tmsp = $this->getTimestamp ( $date );
		return date ( $format , $tmsp );
		
	}
	
	function mesPorExtenso( $month ) {
		
		$arr_month["January"] 	=  "Janeiro" ;
		$arr_month["February"] 	= "Fevereiro" ;
		$arr_month["March"] 	= "Março" ;
		$arr_month["April"] 	= "Abril" ;
		$arr_month["May"] 		= "Maio" ;
		$arr_month["June"] 		= "Junho" ;
		$arr_month["July"] 		= "Julho";
		$arr_month["August"] 	= "Agosto";
		$arr_month["September"] = "Setembro";
		$arr_month["October"] 	= "Outubro";
		$arr_month["November"] 	= "Novembro";
		$arr_month["December"] 	= "Dezembro"	;
		
		return $arr_month[$month] ;
	}
}
