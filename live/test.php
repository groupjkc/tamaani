<?php
/*
 if (strtoupper(substr(PHP_OS,0,3)=='WIN')) {
	 $eol="\n";
 } elseif (strtoupper(substr(PHP_OS,0,3)=='MAC')) {
 	$eol="\r";
 } else {
 	$eol="\n";
 }
 
  

// $headers = 'Subject: Trying' . $eol;
 //$headers = 'Mime-Version:1.0' .$eol;
 $headers = 'Content-Type: text/calendar; method=REQUEST; charset=iso-8859-1' ;
// $headers .= 'Content-Transfer-Encoding: 8bit'.$eol;

$message ='BEGIN:VCALENDAR
PRODID:Google Mail Tnef Converter 1.0
VERSION:2.0
METHOD:REQUEST
BEGIN:VTIMEZONE
TZID:America/New_York
X-TZINFO:America/New_York[2013b/Partial@1303302600000]
BEGIN:DAYLIGHT
TZOFFSETTO:-040000
TZOFFSETFROM:-050000
TZNAME:(DST)
DTSTART:20120311T020000
RRULE:FREQ=YEARLY;BYMONTH=3;BYDAY=2SU
END:DAYLIGHT
BEGIN:STANDARD
TZOFFSETTO:-050000
TZOFFSETFROM:-040000
TZNAME:(STD)
DTSTART:20111106T020000
RRULE:FREQ=YEARLY;BYMONTH=11;BYDAY=1SU
END:STANDARD
END:VTIMEZONE
BEGIN:VEVENT
ORGANIZER;CN="Tamaani Technical Team ":mailto:VC@krg.ca"
CLASS:PUBLIC
UID:VC000013
DTSTART:2013-04-28T17:00:00
DTEND:2013-04-28T18:00:00
ATTENDEE;CN=Tamaani-CAL-VC;CUTYPE=RESOURCE;ROLE=NON-PARTICIPANT:invalid:nom
 ail
CONTACT:Tammani 
SUMMARY:Request # VC000013
UID:1980ef4eff4400f1f30c02f345c4acd2
DESCRIPTION:
X-ALT-DESC;FMTTYPE=text/html:<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">\n<HTML>\n<HEAD>\n<META NAME="Generator" CONTENT="MS Exchange Server version 08.00.0681.000">\n<TITLE></TITLE>\n</HEAD>\n<BODY>\n<P><B><FONT COLOR="#365F91" FACE="Cambria" SIZE=4><span style="color:green">Request Approved # VC000013</span></FONT></B></P><P><FONT FACE="Calibri">The following video conferencing form has been approved.<br>Please add it to your schedule.<br><br> To request a modification to your booking request, <a href="http://beta.jkcommunications.com/tamaani/?Reference=VC000013&lang=en&Code=1980ef4eff4400f1f30c02f345c4acd2#FormMod">
								<strong style="color:#228cbe; font-size:18px;">CLICK HERE</strong> 
							</a></FONT></P><P><B><FONT COLOR="#365F91" FACE="Cambria" SIZE=3>CONTACT & BILLING INFO </FONT></B><BR><FONT FACE="Calibri"> COMPANY/DEPARTMENT NAME     : Test Company<BR>
								P.O. #          : N/A <BR>
								CONTACT NAME: Bob Client <BR>
								ADDRESS: P.O. Box #9 <BR>
								TOWN: Kuujjuaq <BR>
								PROVINCE/STATE: Qc <BR>
								POSTAL/ZIP CODE: J0M 1C0 <BR>
								EMAIL: dominick.leclerc@gmail.com <BR>
								WORK PHONE: 819-964-0006 x230</P><P><B><FONT COLOR="#365F91" FACE="Cambria" SIZE=3>BOOKING DETAILS</FONT></B><BR><FONT FACE="Calibri">DATE OF VC: 2013-04-28<br>
								START TIME: 17:00:00<BR>
								ESTIMATED END TIME: 18:00:00<BR>
								HOW MANY SITES:(MINIMUM OF 2): 2<BR>
								ARE ALL SITES IN NUNAVIK: YES<BR>	
								Special Needs: Testing.<BR>
								First time user: YES</P><P><B><FONT COLOR="#365F91" FACE="Cambria" SIZE=3>SITE   1 </FONT></B><BR><FONT FACE="Calibri"> SITE NAME/LOCATION :  TEST1<BR>
										<B>ROOM RESERVATION CONTACT: </B><br>
										NAME: TEST1	<BR>
										EMAIL: fatiha@jkcommunications.com	<BR>
										PHONE: a	<BR>
										 <B>TECHNICAL CONTACT : </B><BR>
										NAME: TEST1	<BR>
										EMAIL: fatiha@jkcommunications.com	<BR>
										PHONE: TEST1	<BR>										
			  							TECHNOLOGY USED:  IP<BR>IP:                 66.165.216.54	<BR>Equipment Manufacturer: tTEST1	<BR>
							Model: TEST1	<BR></P><P><B><FONT COLOR="#365F91" FACE="Cambria" SIZE=3>SITE   2 </FONT></B><BR><FONT FACE="Calibri"> SITE NAME/LOCATION :  TEST2<BR>
										<B>ROOM RESERVATION CONTACT: </B><br>
										NAME: TEST2	<BR>
										EMAIL: studio@jkcommunications.com	<BR>
										PHONE: TEST2	<BR>
										 <B>TECHNICAL CONTACT : </B><BR>
										NAME: TEST2	<BR>
										EMAIL: studio@jkcommunications.com	<BR>
										PHONE: (819) 964-2961 x 2226	<BR>										
			  							TECHNOLOGY USED:  IP<BR>IP:                 66.165.215.20	<BR>Equipment Manufacturer: TEST2	<BR>
							Model: TEST2	<BR></P></BODY>\n</HTML>
LOCATION:Tamaani
CATEGORIES:VC Tamaani
STATUS:CONFIRMED
URL:http://TAMAANI.CA
CLASS:PUBLIC
PARTSTAT:NEEDS-ACTION
END:VEVENT
END:VCALENDAR
'
;
*/
 
$headers = 'Content-Type: text/calendar; method=REQUEST; charset=iso-8859-1';

if (mail('gcalder@dropzone.com', 'Appointment', 'TEST EMAIL', $headers))
{
 	echo 'EMAIL SENT';
}
else
{
	echo 'EMAIL NOT SENT'; 
}		
?>
    

 