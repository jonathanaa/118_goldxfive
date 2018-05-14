<%CODEPAGE="65001" %>
<%Response.CodePage=65001%>
<%Response.Charset="UTF-8"%>
<!-- #include file="../config/config.inc" -->
<%
	 str = Request.Form("string")
	 speaker = Request.Form("speaker")
	 Volume = Request.Form("Volume")
	 speed = Request.Form("speed")
	 outputType = Request.Form("outputType")
	 pitchLevel = Request.Form("pitchLevel")
	 pitchSign = Request.Form("pitchSign")
	 pitchScale = Request.Form("pitchScale")
	 ConvertID = Request.QueryString("ConvertID")
	 download = Request.QueryString("download")
	 audiofilename = Request.QueryString("audiofilename")
	 
	 If speaker = "" Then speaker = "Bruce" End If
	 If Volume = "" Then Volume = 100 End If
	 If speed = "" Then speed = 0 End If
	 If outputType = "" Then outputType = "wav" End If
	 If pitchLevel = "" Then pitchLevel = 0 End If
	 If pitchSign = "" Then pitchSign = 0 End If
	 If pitchScale = "" Then pitchScale = 5 End If
	
	If Not(str = "") Then
		'Setup Web Service
		Set objSoapClient = Server.CreateObject("MSSoap.SoapClient30")
			objSoapClient.ClientProperty("ServerHTTPRequest") = true
			objSoapClient.MSSoapInit ("http://tts.itri.org.tw/TTSService/Soap_1_3.php?wsdl")	
		'Invoke Call to ConvertText
		dim result
			result = objSoapClient.ConvertAdvancedText(cname,passwd,str,speaker,Volume,speed,outputType,pitchLevel,pitchSign,pitchScale) 
		'Iterate through the returned string array
			resultArray = Split(result,"&")
		dim resultArray
		Set objSoapClient = Nothing
	End If
	
	If Not(ConvertID = "") Then
		'Setup Web Service
		Set objSoapClient = Server.CreateObject("MSSoap.SoapClient30")
			objSoapClient.ClientProperty("ServerHTTPRequest") = true
			objSoapClient.MSSoapInit ("http://tts.itri.org.tw/TTSService/Soap_1_3.php?wsdl")	
		'Invoke Call to ConvertText
			result2=objSoapClient.GetConvertStatus(cname,passwd,ConvertID) 
		dim result2
		'Iterate through the returned string array
			resultArray2 = Split(result2,"&")
			
			If Not(download = "") Then
				Dim oXMLHTTP
				Dim oStream
				
				Set oXMLHTTP = CreateObject("Msxml2.ServerXMLHTTP.3.0")
				
				'Response.Write(resultArray2(4))
				
				oXMLHTTP.Open "GET" , resultArray2(4) , false
				oXMLHTTP.Send
				
				If oXMLHTTP.Status = 200 Then
				Set oStream = Server.createObject("ADODB.Stream")
				oStream.Open
				oStream.Type=1
				oStream.Write oXMLHTTP.responseBody
				oStream.SaveToFile AudiofilesAddress+audiofilename+".wav"
				oStream.Close
				End If
				
				Set fs = Server.CreateObject("Scripting.FileSystemObject")
				If(fs.FileExists(AudiofilesAddress+audiofilename+".wav")) = true Then
					Response.Write("1")
				Else
					Response.Write("0")
				End If
				
				set fs=nothing
			Else
				If resultArray2(2)="2" Then
					response.write resultArray2(0)+"|"+resultArray2(1)+"|"+resultArray2(2)+"|"+resultArray2(3)+"|"+resultArray2(4)
				Else 
					response.write resultArray2(0)+"|"+resultArray2(1)+"|"+resultArray2(2)+"|"+resultArray2(3)+"|"
				End If
			End If
			response.end()
		Set objSoapClient = Nothing
	End If
	
%>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>

		<form id="TTSform" name="TTSform" method="post" action="TTSConverter.asp">
			<input type="text" id="string" name="string">
			<input type="text" id="speaker" name="speaker">
			<input type="text" id="Volume" name="Volume">
			<input type="text" id="speed" name="speed">
			<input type="text" id="outputType" name="outputType">
			<input type="text" id="pitchLevel" name="pitchLevel">
			<input type="text" id="pitchSign" name="pitchSign">
			<input type="text" id="pitchScale" name="pitchScale">
			<input type="text" id="ConvertID" name="ConvertID" value="<% If Not(str = "") Then response.write resultArray(2) End If  %>">
			<input type="submit" value="submit">
		</form>
	</body>
</html>