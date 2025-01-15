<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       ZravianX                                                    ##
##  Version:       2011.10.05                                                  ##
##  Filename:      Templates/news.tpl                                          ##
##  Developed by:  Dzoki                                                       ##
##  Edited by:     ZZJHONS                                                     ##
##  License:       Creative Commons BY-NC-SA 3.0                               ##
##  Copyright:     ZravianX (c) 2011 - All rights reserved                     ##
##  URLs:          http://www.20script.ir                                      ##
##  Source code:   http://www.github.com/ZZJHONS/ZravianX                      ##
##                                                                             ##
#################################################################################

if(NEWSBOX1){include "Templates/News/".$_SESSION['lang']."/newsbox1.tpl";}
if(NEWSBOX2){include "Templates/News/".$_SESSION['lang']."/newsbox2.tpl";}
if(NEWSBOX3){include "Templates/News/".$_SESSION['lang']."/newsbox3.tpl";}
?>