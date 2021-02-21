Function Invoke-WebHookPlex {
	<#
	.SYNOPSIS
	Short description

	.DESCRIPTION
	Long description

	.EXAMPLE
	An example

	.NOTES
	General notes
		2021-02-19: GS - Update WebHookPlex with more detailed endpoint data.
	#>
	[CmdletBinding()]
	Param (
		[String]$WebHookUri = "http://localhost/tests/webhook/webhookinput.php",
		[Int]$TimeOutSec = 10,
		[Switch]$invoke
	)

	If ($PSBoundParameters['Debug']) {
		$DebugPreference = "Continue"
	}
	<# ---------------------------------------------------
	Script: C:\Users\stefstr\Microsoft\OneDrive - Microsoft\Scripts\PS\MicrosoftTeams\testwebhook_v2.ps1
	Version: 0.1
	Author: Stefan Stranger
	Date: 11/03/2016 10:48:58
	Description: Call Microsoft Teams Incoming Webhook from PowerShell
	Comments:
	Changes:
	Disclaimer:
	This example is provided “AS IS” with no warranty expressed or implied. Run at your own risk.
	**Always test in your lab first**  Do this at your own risk!!
	The author will not be held responsible for any damage you incur when making these changes!

	https://blogs.technet.microsoft.com/stefan_stranger/2016/11/03/use-webhook-connector-to-send-data-from-powershell-to-microsoft-teams/
	---------------------------------------------------#>
	$Sample_File = "SampleWebHook.json"
	$Sample_Directory = $PSScriptRoot
	$Sample_FullName = [IO.Path]::Combine($Sample_Directory, $Sample_File)

	$Body = Get-Content $Sample_FullName | Out-String | ConvertFrom-Json

	# $Body = @{
	# 		'event'= "media.play"
	# }
	
	$params = @{
		Headers = @{'accept'='application/json'}
		Body = $Body | convertto-json
		Method = 'Post'
		URI = $WebHookUri
	}

	If ($invoke) {
		Try {
			Invoke-RestMethod @params -TimeoutSec $TimeOutSec -ErrorAction SilentlyContinue | Out-Null
		}
		Catch {
			Write-Output "WebHook Message was unable to send message."
		}
		Finally {
			Write-Output $body.Text
		}
	}
	# Else {
		Write-Output "--------------------------"
		Write-Output "----- WebHook (Test) -----"
		Write-Output "--------------------------"
		Write-Output " "
		Write-Output "Web Hook URI: $($WebHookUri)"
		Write-Output " "
		Write-Output $Body
		Write-Output "--------------------------"
	# }
}

Invoke-WebHookPlex -invoke
