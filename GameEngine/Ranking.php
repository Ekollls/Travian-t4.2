<?php
/**********************************************
/ All Of the Copy Rights Of The Script Is Reserved For mersad_mr@att.net
/	You may have made some changes but You Have No Right To remove This Copy Right!
/	For Debug And Support Just Contact Me : mersad_mr@att.net
/	Mobile: 09127679667  / Yahoo ID : mersad_mr@att.net
/
*/
        class Ranking {
			
			public function getUserRank($username) {
        		$q = "SELECT " . TB_PREFIX . "users.id userid, " . TB_PREFIX . "users.RR totalraid, " . TB_PREFIX . "users.username username, (
				SELECT SUM( " . TB_PREFIX . "vdata.pop ) 
				FROM " . TB_PREFIX . "vdata
				WHERE " . TB_PREFIX . "vdata.owner = userid
				)totalpop 
				FROM " . TB_PREFIX . "users
				WHERE " . TB_PREFIX . "users.id > 3
				ORDER BY totalpop DESC,totalraid DESC, userid ASC";
				$result = mysql_query($q);
				$myrank = 0;
				while($row = mysql_fetch_array($result)) {
					$myrank+=1;
					if(strcasecmp($row['username'],$username)==0){
						break;
					}
				}
				return $myrank;
        	}
			
			public function getUserAttRank($username) {
				$q = "SELECT " . TB_PREFIX . "users.id userid, " . TB_PREFIX . "users.username username, " . TB_PREFIX . "users.apall apall
				FROM " . TB_PREFIX . "users
				WHERE " . TB_PREFIX . "users.id > 3
				ORDER BY apall DESC, userid ASC";
					
				$result = mysql_query($q);
				$i = 1;
				$myrank = 0;
				while($row = mysql_fetch_array($result)) {
					if(strcasecmp($row['username'],$username)==0){
						$myrank = $i;
					}
					$i++;
				}
				return $myrank;
        	}
			
			public function getUserDefRank($username) {
				$q = "SELECT " . TB_PREFIX . "users.id userid, " . TB_PREFIX . "users.username username, " . TB_PREFIX . "users.dpall dpall
				FROM " . TB_PREFIX . "users
				WHERE " . TB_PREFIX . "users.id > 3
				ORDER BY dpall DESC, userid ASC";
					
				$result = mysql_query($q);
				$i = 1;
				$myrank = 0;
				while($row = mysql_fetch_array($result)) {
					if(strcasecmp($row['username'],$username)==0){
						$myrank = $i;
					}
					$i++;
				}
				return $myrank;
        	}
			
			public function getAllianceRank($id) {
        		$result = $this->procAllianceRanking(/*$limit*/);
				$i = 1;
				$myrank = 0;
				while($row = mysql_fetch_array($result)) {
					if($row['id'] == $id){
						$myrank = $i;
					}
					$i++;
				}
				return $myrank;
        	}
			
			public function getAllianceAttRank($id) {
				$q = "SELECT " . TB_PREFIX . "users.id userid, " . TB_PREFIX . "users.username username, " . TB_PREFIX . "users.alliance alliance, (
				
				SELECT SUM( " . TB_PREFIX . "alidata.Aap ) 
				FROM " . TB_PREFIX . "alidata
				WHERE " . TB_PREFIX . "alidata.id = alliance
				)totalpoint
				
				FROM " . TB_PREFIX . "users
				WHERE " . TB_PREFIX . "users.alliance > 0
				ORDER BY totalpoint DESC, alliance ASC";
					
				$result = mysql_query($q);
				$i = 1;
				$myrank = 0;
				while($row = mysql_fetch_array($result)) {
					if($row['alliance'] == $id){
						$myrank = $i;
					}
					$i++;
				}
				return $myrank;
        	}
			
			public function getAllianceDefRank($id) {
				$q = "SELECT " . TB_PREFIX . "users.id userid, " . TB_PREFIX . "users.username username, " . TB_PREFIX . "users.alliance alliance, (
				
				SELECT SUM( " . TB_PREFIX . "alidata.Adp ) 
				FROM " . TB_PREFIX . "alidata
				WHERE " . TB_PREFIX . "alidata.id = alliance
				)totalpoint
				
				FROM " . TB_PREFIX . "users
				WHERE " . TB_PREFIX . "users.alliance > 0
				ORDER BY totalpoint DESC, alliance ASC";
					
				$result = mysql_query($q);
				$i = 1;
				$myrank = 0;
				while($row = mysql_fetch_array($result)) {
					if($row['alliance'] == $id){
						$myrank = $i;
					}
					$i++;
				}
				return $myrank;
        	}
			
			
			
			
			public function procUsersRanking($limit="") {
				$q = "SELECT " . TB_PREFIX . "users.id userid, " . TB_PREFIX . "users.username username," . TB_PREFIX . "users.alliance alliance, (
				SELECT SUM( " . TB_PREFIX . "vdata.pop ) 
				FROM " . TB_PREFIX . "vdata
				WHERE " . TB_PREFIX . "vdata.owner = userid
				)totalpop, (

				SELECT SUM( " . TB_PREFIX . "users.RR ) 
				FROM " . TB_PREFIX . "users
				WHERE " . TB_PREFIX . "users.id = userid
				)totalraid, (
				
				SELECT COUNT( " . TB_PREFIX . "vdata.wref ) 
				FROM " . TB_PREFIX . "vdata
				WHERE " . TB_PREFIX . "vdata.owner = userid AND type != 99
				)totalvillages, (
		
				SELECT " . TB_PREFIX . "alidata.tag
				FROM " . TB_PREFIX . "alidata, " . TB_PREFIX . "users
				WHERE " . TB_PREFIX . "alidata.id = " . TB_PREFIX . "users.alliance
				AND " . TB_PREFIX . "users.id = userid
				)allitag
					
				FROM " . TB_PREFIX . "users
				WHERE " . TB_PREFIX . "users.id !=0 AND id !=2 AND id !=3
				ORDER BY totalpop DESC, totalraid DESC, userid ASC $limit";
				return mysql_query($q);
			}
						
			public function procUsersAttRanking($limit="") {
				$q = "SELECT " . TB_PREFIX . "users.id userid, " . TB_PREFIX . "users.username username, " . TB_PREFIX . "users.apall apall, (
				SELECT SUM( " . TB_PREFIX . "vdata.pop ) 
				FROM " . TB_PREFIX . "vdata
				WHERE " . TB_PREFIX . "vdata.owner = userid
				)totalpop, (
					
				SELECT COUNT( " . TB_PREFIX . "vdata.wref ) 
				FROM " . TB_PREFIX . "vdata
				WHERE " . TB_PREFIX . "vdata.owner = userid AND type != 99
				)totalvillages
				
				FROM " . TB_PREFIX . "users
				WHERE " . TB_PREFIX . "users.id > 3
				ORDER BY apall DESC, userid ASC $limit";
				return mysql_query($q);
			}
			
			
			public function procUsersDefRanking($limit="") {
				$q = "SELECT " . TB_PREFIX . "users.id userid, " . TB_PREFIX . "users.username username, " . TB_PREFIX . "users.dpall dpall, (
				SELECT SUM( " . TB_PREFIX . "vdata.pop ) 
				FROM " . TB_PREFIX . "vdata
				WHERE " . TB_PREFIX . "vdata.owner = userid
				)totalpop, (
						
				SELECT COUNT( " . TB_PREFIX . "vdata.wref ) 
				FROM " . TB_PREFIX . "vdata
				WHERE " . TB_PREFIX . "vdata.owner = userid AND type != 99
				)totalvillages
					
				FROM " . TB_PREFIX . "users
				WHERE " . TB_PREFIX . "users.id > 3
				ORDER BY dpall DESC, userid ASC $limit";
				return mysql_query($q);
			}

			public function procAllianceRanking($limit="") {
				$q = 'SELECT *,(SELECT COUNT(*) FROM '.TB_PREFIX.'users WHERE '.TB_PREFIX.'users.alliance='.TB_PREFIX.'alidata.id) AS memcount
,(SELECT SUM((SELECT SUM('.TB_PREFIX.'vdata.pop) FROM '.TB_PREFIX.'vdata WHERE '.TB_PREFIX.'vdata.owner='.TB_PREFIX.'users.id)) FROM '.TB_PREFIX.'users
WHERE '.TB_PREFIX.'alidata.id='.TB_PREFIX.'users.alliance) AS totalpop
FROM '.TB_PREFIX.'alidata WHERE 1 ORDER BY totalpop DESC, id ASC '.$limit;
				
				return mysql_query($q);
			}
			
			public function procAllianceTop10PopRanking($limit="") {
				$q = 'SELECT *,(SELECT COUNT(*) FROM '.TB_PREFIX.'users WHERE '.TB_PREFIX.'users.alliance='.TB_PREFIX.'alidata.id) AS memcount
,(SELECT SUM((SELECT SUM('.TB_PREFIX.'vdata.pop) FROM '.TB_PREFIX.'vdata WHERE '.TB_PREFIX.'vdata.owner='.TB_PREFIX.'users.id)) FROM '.TB_PREFIX.'users
WHERE '.TB_PREFIX.'alidata.id='.TB_PREFIX.'users.alliance)-'.TB_PREFIX.'alidata.oldrank AS top10popchange
FROM '.TB_PREFIX.'alidata WHERE 1 ORDER BY top10popchange DESC, id ASC '.$limit;

				return mysql_query($q);
			}
			
			public function procAllianceAttRanking($limit="") {
				$q = 'SELECT *,(SELECT COUNT(*) FROM '.TB_PREFIX.'users WHERE '.TB_PREFIX.'users.alliance='.TB_PREFIX.'alidata.id) AS memcount
,(SELECT SUM((SELECT SUM('.TB_PREFIX.'vdata.pop) FROM '.TB_PREFIX.'vdata WHERE '.TB_PREFIX.'vdata.owner='.TB_PREFIX.'users.id)) FROM '.TB_PREFIX.'users
WHERE '.TB_PREFIX.'alidata.id='.TB_PREFIX.'users.alliance) AS totalpop
FROM '.TB_PREFIX.'alidata WHERE 1 ORDER BY Aap DESC, id ASC '.$limit;
				return mysql_query($q);
			}
			
			public function procAllianceDefRanking($limit="") {
				$q = 'SELECT *,(SELECT COUNT(*) FROM '.TB_PREFIX.'users WHERE '.TB_PREFIX.'users.alliance='.TB_PREFIX.'alidata.id) AS memcount
,(SELECT SUM((SELECT SUM('.TB_PREFIX.'vdata.pop) FROM '.TB_PREFIX.'vdata WHERE '.TB_PREFIX.'vdata.owner='.TB_PREFIX.'users.id)) FROM '.TB_PREFIX.'users
WHERE '.TB_PREFIX.'alidata.id='.TB_PREFIX.'users.alliance) AS totalpop
FROM '.TB_PREFIX.'alidata WHERE 1 ORDER BY Adp DESC, id ASC '.$limit;
				return mysql_query($q);
			}
						
			public function getATop10AttRank($id) {
				$q = "SELECT " . TB_PREFIX . "alidata.id allyid, " . TB_PREFIX . "alidata.ap ap
				FROM " . TB_PREFIX . "alidata
				WHERE " . TB_PREFIX . "alidata.id > 0
				ORDER BY ap DESC, allyid ASC";
					
				$result = mysql_query($q);
				$i = 1;
				$myrank = 0;
				while($row = mysql_fetch_array($result)) {
					if($row['allyid'] == $id){
						$myrank = $i;
					}
					$i++;
				}
				return $myrank;
        	}
			
			
			public function getATop10DefRank($id) {
				$q = "SELECT " . TB_PREFIX . "alidata.id allyid, " . TB_PREFIX . "alidata.dp dp
				FROM " . TB_PREFIX . "alidata
				WHERE " . TB_PREFIX . "alidata.id > 0
				ORDER BY dp DESC, allyid ASC";
					
				$result = mysql_query($q);
				$i = 1;
				$myrank = 0;
				while($row = mysql_fetch_array($result)) {
					if($row['allyid'] == $id){
						$myrank = $i;
					}
					$i++;
				}
				return $myrank;
        	}
			
			
			public function getATop10ClpRank($id) {
				$q = "SELECT " . TB_PREFIX . "alidata.id allyid, " . TB_PREFIX . "alidata.clp clp
				FROM " . TB_PREFIX . "alidata
				WHERE " . TB_PREFIX . "alidata.id > 0
				ORDER BY clp DESC, allyid ASC";
					
				$result = mysql_query($q);
				$i = 1;
				$myrank = 0;
				while($row = mysql_fetch_array($result)) {
					if($row['allyid'] == $id){
						$myrank = $i;
					}
					$i++;
				}
				return $myrank;
        	}
			
			public function getATop10RobbersRank($id) {
				$q = "SELECT " . TB_PREFIX . "alidata.id allyid, " . TB_PREFIX . "alidata.RR RR
				FROM " . TB_PREFIX . "alidata
				WHERE " . TB_PREFIX . "alidata.id > 0
				ORDER BY RR DESC, allyid ASC";
					
				$result = mysql_query($q);
				$i = 1;
				$myrank = 0;
				while($row = mysql_fetch_array($result)) {
					if($row['allyid'] == $id){
						$myrank = $i;
					}
					$i++;
				}
				return $myrank;
        	}
			
			
			
			
			
			public function getVillageRank($wid) {
        		$q = "SELECT * FROM ".TB_PREFIX."vdata WHERE wref != 0 AND owner != 2 ORDER BY pop DESC, name ASC, lastupdate DESC";
				$result = mysql_query($q);
				$i = 1;
				$myrank = 0;
				while($row = mysql_fetch_array($result)) {
					if($row['wref'] == $wid){
						$myrank = $i;
					}
					$i++;
				}
				return $myrank;
        	}
			
			public function procVillagesRanking($limit="") {				
				$q = "SELECT * FROM ".TB_PREFIX."vdata WHERE wref != 0 AND owner != 2 ORDER BY pop DESC, name ASC, lastupdate DESC $limit";
				return mysql_query($q);
			}
			
			public function getTop10AttRank($username) {
				$q = "SELECT " . TB_PREFIX . "users.id userid, " . TB_PREFIX . "users.username username, " . TB_PREFIX . "users.ap ap, (
				SELECT SUM( " . TB_PREFIX . "vdata.pop ) 
				FROM " . TB_PREFIX . "vdata
				WHERE " . TB_PREFIX . "vdata.owner = userid
				)totalpop, (
					
				SELECT COUNT( " . TB_PREFIX . "vdata.wref ) 
				FROM " . TB_PREFIX . "vdata
				WHERE " . TB_PREFIX . "vdata.owner = userid AND type != 99
				)totalvillages
				
				FROM " . TB_PREFIX . "users
				WHERE " . TB_PREFIX . "users.id > 3
				ORDER BY ap DESC, userid ASC";
					
				$result = mysql_query($q);
				$i = 1;
				$myrank = 0;
				while($row = mysql_fetch_array($result)) {
					if(strcasecmp($row['username'],$username)==0){
						$myrank = $i;
					}
					$i++;
				}
				return $myrank;
        	}
			
			
			public function getTop10DefRank($username) {
				$q = "SELECT " . TB_PREFIX . "users.id userid, " . TB_PREFIX . "users.username username, " . TB_PREFIX . "users.dp dp, (
				SELECT SUM( " . TB_PREFIX . "vdata.pop ) 
				FROM " . TB_PREFIX . "vdata
				WHERE " . TB_PREFIX . "vdata.owner = userid
				)totalpop, (
					
				SELECT COUNT( " . TB_PREFIX . "vdata.wref ) 
				FROM " . TB_PREFIX . "vdata
				WHERE " . TB_PREFIX . "vdata.owner = userid AND type != 99
				)totalvillages
				
				FROM " . TB_PREFIX . "users
				WHERE " . TB_PREFIX . "users.id > 3
				ORDER BY dp DESC, userid ASC";
					
				$result = mysql_query($q);
				$i = 1;
				$myrank = 0;
				while($row = mysql_fetch_array($result)) {
					if(strcasecmp($row['username'],$username)==0){
						$myrank = $i;
					}
					$i++;
				}
				return $myrank;
        	}
			
			
			public function getTop10ClpRank($username) {
				$q = "SELECT " . TB_PREFIX . "users.id userid, " . TB_PREFIX . "users.username username, " . TB_PREFIX . "users.clp clp, (
				SELECT SUM( " . TB_PREFIX . "vdata.pop ) 
				FROM " . TB_PREFIX . "vdata
				WHERE " . TB_PREFIX . "vdata.owner = userid
				)totalpop, (
					
				SELECT COUNT( " . TB_PREFIX . "vdata.wref ) 
				FROM " . TB_PREFIX . "vdata
				WHERE " . TB_PREFIX . "vdata.owner = userid AND type != 99
				)totalvillages
				
				FROM " . TB_PREFIX . "users
				WHERE " . TB_PREFIX . "users.id > 3
				ORDER BY totalpop DESC, userid ASC";
					
				$result = mysql_query($q);
				$i = 1;
				$myrank = 0;
				while($row = mysql_fetch_array($result)) {
					if(strcasecmp($row['username'],$username)==0){
						$myrank = $i;
					}
					$i++;
				}
				return $myrank;
        	}
			
			public function procUsersTop10PopRank($limit='') {
				$q = "SELECT " . TB_PREFIX . "users.id userid, " . TB_PREFIX . "users.username username, 
				((SELECT SUM( " . TB_PREFIX . "vdata.pop ) 
				FROM " . TB_PREFIX . "vdata
				WHERE " . TB_PREFIX . "vdata.owner = userid
				)-oldrank)top10popchange
				
				FROM " . TB_PREFIX . "users
				WHERE " . TB_PREFIX . "users.id > 3
				ORDER BY top10popchange DESC, userid ASC ".$limit;
				
				return mysql_query($q);
        	}
			
			public function getTop10RobbersRank($username) {
				$q = "SELECT " . TB_PREFIX . "users.id userid, " . TB_PREFIX . "users.username username, " . TB_PREFIX . "users.RR RR, (
				SELECT SUM( " . TB_PREFIX . "vdata.pop ) 
				FROM " . TB_PREFIX . "vdata
				WHERE " . TB_PREFIX . "vdata.owner = userid
				)totalpop, (
					
				SELECT COUNT( " . TB_PREFIX . "vdata.wref ) 
				FROM " . TB_PREFIX . "vdata
				WHERE " . TB_PREFIX . "vdata.owner = userid AND type != 99
				)totalvillages
				
				FROM " . TB_PREFIX . "users
				WHERE " . TB_PREFIX . "users.id > 3
				ORDER BY RR DESC, userid ASC";
					
				$result = mysql_query($q);
				$i = 1;
				$myrank = 0;
				while($row = mysql_fetch_array($result)) {
					if(strcasecmp($row['username'],$username)==0){
						$myrank = $i;
					}
					$i++;
				}
				return $myrank;
        	}
        }
        ;

        $ranking = new Ranking;

?>
