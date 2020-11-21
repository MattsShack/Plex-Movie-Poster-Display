#!/usr/bin/env python3
import sys, getopt, random

class CustomSettings:
    className = "CustomSettings"
    className_string = "Custom Settings"

    import os
    import subprocess
    import configparser

    def __init__(self,DisplayMSG=False,OSPlatform="linux",DefaultConfigFile="DockerSetup.config"):
        self.DefaultConfigFile = DefaultConfigFile
        self.Config_DisplayMSG = DisplayMSG

        self.OSPlatform = OSPlatform

        self.LoadConfig() # Load predefined values from configuration file

    def LoadConfig(self,DisplayMSG=False):
        ConfigFilePath = self.os.path.join(self.DefaultConfigFile)

        self.configfile = self.configparser.RawConfigParser(allow_no_value=True)
        self.configfile.read(ConfigFilePath)

        ConfigSegment = "PLEX"

        self.PLEX_TOKEN = self.configfile.get(ConfigSegment, 'PLEX_TOKEN')
        self.PLEX_SERVER_IP = self.configfile.get(ConfigSegment, 'PLEX_SERVER_IP')
        self.PLEX_MOVIE_SECTIONS = self.configfile.get(ConfigSegment, 'PLEX_MOVIE_SECTIONS')


    def DisplayClassInfo(self,DisplayMSG=True):
        self.UpdateVariables()

        if DisplayMSG == True or self.Config_DisplayMSG == True:
            print ("")
            print ("\tPlex Token (PLEX_TOKEN): {}".format(self.PLEX_TOKEN))
            print ("\tPlex Server IP (PLEX_SERVER_IP): {}".format(self.PLEX_SERVER_IP))
            print ("\tPlex Movie Section(s) (PLEX_MOVIE_SECTIONS): {}".format(self.PLEX_MOVIE_SECTIONS))

    def DisplayClassActions(self,DisplayMSG=False):
        MethodStatus = "EMPTY" # Create an empty variable for empty methoud to be used in the future.
        
        # if DisplayMSG == True or self.Config_DisplayMSG == True:
            # print ("")

    def DisplayHelpInfo(self,DisplayMSG=False):
        MethodStatus = "EMPTY" # Create an empty variable for empty methoud to be used in the future.
        
        # if DisplayMSG == True or self.Config_DisplayMSG == True:
            # print ("")

    def DisplayHelpInfo_Options(self,DisplayMSG=False):
        MethodStatus = "EMPTY" # Create an empty variable for empty methoud to be used in the future.
        
        # if DisplayMSG == True or self.Config_DisplayMSG == True:
            # print ("")

    def DisplayHelpInfo_MgtCommands(self,DisplayMSG=False):
        MethodStatus = "EMPTY" # Create an empty variable for empty methoud to be used in the future.
        
        # if DisplayMSG == True or self.Config_DisplayMSG == True:
            # print ("")

    def DisplayHelpInfo_Commands(self,DisplayMSG=False):
        MethodStatus = "EMPTY" # Create an empty variable for empty methoud to be used in the future.
        
        # if DisplayMSG == True or self.Config_DisplayMSG == True:
            # print ("")

    def Actions(self,DisplayMSG=False):
        MethodStatus = "EMPTY" # Create an empty variable for empty methoud to be used in the future.
        # print ("")

    def UpdateVariables(self,DisplayMSG=False):
        MethodStatus = "EMPTY" # Create an empty variable for empty methoud to be used in the future.
        # print("")

    def RunContainer(self,DisplayMSG=False):
        self.UpdateVariables()
        self.ValidateVariables()

        self.RunParameters = ""

    def ValidateVariables(self,DisplayMSG=False):
            self.UpdateVariables()


class DockerCompile:
    className = "DockerCompile"
    className_string = "Docker Compile"

    import os
    import subprocess
    import configparser

    def __init__(self,DisplayMSG=False):
        self.ScriptPath = self.os.path.dirname(self.os.path.realpath('__file__'))
        
        self.ConfigFileName = "DockerSetup.config"
        self.ConfigPath = self.os.path.abspath(self.os.path.join(self.ScriptPath))
        self.ConfigFileFullName = self.os.path.abspath(self.os.path.join(self.ConfigPath, self.ConfigFileName))

        self.DefaultConfigFile = self.ConfigFileFullName
        self.Config_DisplayMSG = DisplayMSG
        self.DockerfileRoot = "."

        self.OSPlatform = "linux"
        self.ImageType = ""
        self.imageNameRoot = ""
        self.tag = ""

        self.PortExternal = 80
        self.PortInternal = 80

        self.NetworkType = ""

        self.LoadConfig() # Load predefined values from configuration file

        self.CustomSettings = CustomSettings(OSPlatform=self.OSPlatform,DefaultConfigFile=self.DefaultConfigFile)

        self.UpdateVariables()
        self.DisplayClassInfo()

        self.Action_ListImages = False
        self.Action_RemoveImage = False
        self.Action_BuildImage = False
        self.Action_StopRemoveContainer = False
        self.Action_RunContainer = False

        self.DisplayClassActions(DisplayMSG=DisplayMSG)

    def LoadConfig(self,DisplayMSG=False):
        ConfigFilePath = self.os.path.join(self.DefaultConfigFile)

        self.configfile = self.configparser.RawConfigParser(allow_no_value=True)
        self.configfile.read(ConfigFilePath)

        ConfigSegment = "DEFAULT"
        
        self.PortExternal = self.configfile.get(ConfigSegment, 'PortExternal')
        self.PortInternal = self.configfile.get(ConfigSegment, 'PortInternal')
        
        self.OSPlatform = self.configfile.get(ConfigSegment, 'OSPlatform')
        self.OSPlatform = self.OSPlatform.lower()
        
        self.imageNameRoot = self.configfile.get(ConfigSegment, 'imageNameRoot')
        self.imageNameRoot = self.imageNameRoot.lower()

        self.tag = self.configfile.get(ConfigSegment, 'tag')
        self.tag = self.tag.lower()

        self.DockerfileRoot = self.configfile.get(ConfigSegment, 'DockerfileRoot')

        self.ImageType = self.configfile.get(ConfigSegment, 'ImageType')
        if self.ImageType:
            # print ("DEBUG: ImageType was empty, setting to _Basic")
            self.ImageType = "_Basic"

        self.NetworkType = self.configfile.get(ConfigSegment, 'NetworkType')
        self.NetworkType = self.NetworkType.lower()

    def DisplayClassInfo(self,DisplayMSG=False):
        self.UpdateVariables()

        if DisplayMSG == True or self.Config_DisplayMSG == True:
            print ("\n{} (Information):".format(self.className_string))
            print ("\tDockerfile (root): {}".format(self.DockerfileRoot))
            print ("\tDockerfile (path): {}".format(self.DockerfilePath))
            print ("\tDocker Image (Root Name): {}".format(self.imageNameRoot))
            print ("\tDocker Image (Base Name): {}".format(self.imageNameBase))
            print ("\tDocker Image (tag): {}".format(self.tag))
            print ("\tDocker Image (imageNameFull): {}".format(self.imageNameFull))
            print ("\tDocker Image (container): {}".format(self.containerName))
            print ("")
            print ("\tPort (External): {}".format(self.PortExternal))
            print ("\tPort (Internal): {}".format(self.PortInternal))
            print ("\tNetwork Type: {}".format(self.NetworkType))
            self.CustomSettings.DisplayClassInfo()

    def DisplayClassActions(self,DisplayMSG=False):
        if DisplayMSG == True or self.Config_DisplayMSG == True:
            print ("\n{} (Actions):".format(self.className_string))
            print ("\tList Images (Action_ListImages): {}".format(self.Action_ListImages))
            print ("\tRemove Image (Action_RemoveImage): {}".format(self.Action_RemoveImage))
            print ("\tBuild Image (Action_BuildImage): {}".format(self.Action_BuildImage))
            print ("\tStop Remove Container (Action_StopRemoveContainer): {}".format(self.Action_StopRemoveContainer))
            print ("\tRun Container (Action_RunContainer): {}".format(self.Action_RunContainer))

    def DisplayHelpInfo(self,DisplayMSG=False):
        #Notes: Help structure based off of 'docker --help' command
        # if DisplayMSG == True or self.Config_DisplayMSG == True:
            print ("\nUsage: DockerSetup.py [OPTIONS] COMMAND\n")
            print ("A self-sufficient runtime for building images and running containers\n")
            print ("Options:")
            print ("      --config \t\t\t Displays the current configuration")
            print ("  -d, --display \t\t Sets the Display Message flag for the rest of the configuration")
            print ("  -b, --build \t\t\t Build docker image")
            print ("  -p, --port \t\tstring  Sets the External port the image will be exposed (default \"80\")")
            print ("      --portInt \tstring  Explicit Internal port (default \"80\")")
            print ("      --portExt \tstring  Explicit External port (default \"80\")")
            print ("  -t, --tag \t\tstring  Tag Image")
            print ("  -r, --run \t\t\t Start/Run docker container and built image")
            print ("  -i, --images \t\t\t List images that match current configuration")
            self.CustomSettings.DisplayHelpInfo_Options()

            print ("\nManagement Commands:")
            print ("  image \tManage images")
            self.CustomSettings.DisplayHelpInfo_MgtCommands()

            print ("\nCommands:")
            print ("  build \tBuild an image from a Dockerfile")
            print ("  images \tList images")
            print ("  port \t\tList port mappings or a specific mapping for the container")
            print ("  rm \t\tRemove one or more containers")
            print ("  run \t\tRun a command in a new container")
            print ("  stop \t\tStop one or more running containers")
            print ("  tag \t\tCreate a tag TARGET_IMAGE that refers to SOURCE_IMAGE")
            self.CustomSettings.DisplayHelpInfo_Commands()

            print ("\nRun 'DockerSetup COMMAND --help' for more information on a command.")

    def Actions(self,DisplayMSG=False):
        if self.Action_ListImages == True:
            if DisplayMSG == True or self.Config_DisplayMSG == True:
                print ("Listing Images...")

            self.ListImages()
        else:
            if DisplayMSG == True or self.Config_DisplayMSG == True:
                print ("No List Images Set")

        if self.Action_BuildImage == True:
            if DisplayMSG == True or self.Config_DisplayMSG == True:
                print ("Building Image...")

            self.RemoveImage()
            self.BuildImage()
        else:
            if DisplayMSG == True or self.Config_DisplayMSG == True:
                print ("No Build Action Set")

        if self.Action_RunContainer == True:
            if DisplayMSG == True or self.Config_DisplayMSG == True:
                print ("Running Image...")

            self.StopRemoveContainer()
            self.RunContainer()
        else:
            if DisplayMSG == True or self.Config_DisplayMSG == True:
                print ("No Run Action Set")

    def UpdateVariables(self,DisplayMSG=False):
        self.CustomSettings.UpdateVariables()
        self.imageNameBase = ("{}{}".format(self.imageNameRoot,self.OSPlatform))

        self.DockerfilePath = ("{}".format(self.DockerfileRoot))

        self.imageNameFull = ("{}:{}".format(self.imageNameBase,self.tag))
        self.containerName = ("{}instance".format(self.imageNameBase))

    def ListImages(self,DisplayMSG=False):
        self.UpdateVariables()

        print ("\nList Images (Full Name): {}\n".format(self.imageNameFull))
        cmd = "docker images {}".format(self.imageNameFull)
        # print ("{}".format(cmd))

        # ImageList = self.subprocess.check_output(cmd,shell = True)
        # print(ImageList)

        # self.subprocess.check_output(cmd,shell = True)
        self.subprocess.run(cmd,shell = True)

    def RemoveImage(self,DisplayMSG=False):
        self.UpdateVariables()

        print ("\nRemove Image (Full Name): {}\n".format(self.imageNameFull))
        cmd = "docker image rm {}".format(self.imageNameFull)
        # print ("{}".format(cmd))

        self.subprocess.run(cmd,shell = True)

    def BuildImage(self,DisplayMSG=False):
        self.UpdateVariables()

        print ("\nBuild Image (Full Name): {}\n".format(self.imageNameFull))
        cmd = ("docker build -t {} {}".format(self.imageNameFull,self.DockerfilePath))
        # print ("{}".format(cmd))

        self.subprocess.run(cmd,shell = True)

    def StopContainer(self,DisplayMSG=False):
        self.UpdateVariables()

        print ("\nStop Container: {}\n".format(self.containerName))
        cmd = ("docker stop {}".format(self.containerName))
        # print ("{}".format(cmd))

        self.subprocess.run(cmd,shell = True)

    def RemoveContainer(self,DisplayMSG=False):
        self.UpdateVariables()

        print ("\nRemove Container: {}\n".format(self.containerName))
        cmd = ("docker rm {}".format(self.containerName))
        # print ("{}".format(cmd))

        self.subprocess.run(cmd,shell = True)

    def StopRemoveContainer(self,DisplayMSG=False):
        self.UpdateVariables()

        print ("\nStop and Remove Container: {}\n".format(self.containerName))
        cmd = ("docker rm -f {}".format(self.containerName))
        # print ("{}".format(cmd))

        self.subprocess.run(cmd,shell = True)

    def RunContainer(self,DisplayMSG=False):
        self.UpdateVariables()
        self.ValidateVariables()
        self.CustomSettings.RunContainer()

        self.RunParameters = ""
        
        self.RunParameters = "{} -d".format(self.RunParameters)
        
        self.RunParameters = "{} -p {}:{}".format(self.RunParameters,self.PortExternal,self.PortInternal)

        if self.CustomSettings.RunParameters:
            self.RunParameters = "{} {}".format(self.RunParameters,self.CustomSettings.RunParameters)

        if self.NetworkType.lower() == 'host':
            self.RunParameters = "{} --network=\"host\"".format(self.RunParameters)

        if self.containerName:
            self.RunParameters = "{} --name {}".format(self.RunParameters,self.containerName)

        print ("\nRun Container: ")
        print ("\tContainer Name: {}".format(self.containerName))
        print ("\tImage Name: {}".format(self.imageNameFull))
        print ("\tPorts: {}:{}\n".format(self.PortExternal,self.PortInternal))

        cmd = ("docker run {} {}".format(self.RunParameters,self.imageNameFull))

        if DisplayMSG == True or self.Config_DisplayMSG == True:
            print ("{}".format(cmd))

        self.subprocess.run(cmd,shell = True)

    def ValidateVariables(self,DisplayMSG=False):
        self.UpdateVariables()

        self.CustomSettings.ValidateVariables()

    def dockerCompose(self,DisplayMSG=False):
        MethodStatus = "EMPTY" # Create an empty variable for empty methoud to be used in the future.
        
        # self.UpdateVariables()

        # print ("\nBuild Image (Full Name): {}\n".format(self.imageNameFull))
        # cmd = ("docker build -t {} ../.".format(self.imageNameFull))
        # # print ("{}".format(cmd))

        # self.subprocess.run(cmd,shell = True)


def main(argv):
   DockerSetup = DockerCompile()

   short_options = "cbdhrip:t:"
   long_options = ["config","display","port=","portInt=","portExt=","tag=","build","run","images","help"]

   try:
      opts, args = getopt.getopt(argv,short_options,long_options)
   except getopt.GetoptError:
      print ("Incorrect Inputs detected \nAgentSetup.py --help")
      DockerSetup.DisplayHelpInfo()
      sys.exit(2)
   for opt, arg in opts:
    #   if opt == '-h' or opt == "--help":
      if opt in ("-h", "--help"):
         DockerSetup.DisplayHelpInfo()
         sys.exit()
      elif opt in ("-p", "--port"):
         DockerSetup.PortExternal = arg
      elif opt in ("--portInt"):
         DockerSetup.PortInternal = arg
      elif opt in ("--portExt"):
         DockerSetup.PortExternal = arg
      elif opt in ("-d", "--display"):
        DockerSetup.Config_DisplayMSG = True
      elif opt in ("-b", "--build"):
         DockerSetup.Action_BuildImage = True
      elif opt in ("-r", "--run"):
         DockerSetup.Action_RunContainer = True
      elif opt in ("-i", "--images"):
         DockerSetup.Action_ListImages = True
      elif opt in ("-t", "--tag"):
         DockerSetup.tag = arg
         DockerSetup.DisplayClassInfo()
      elif opt in ("-c","--config"):
          DockerSetup.DisplayClassInfo(DisplayMSG=True)
          DockerSetup.DisplayClassActions(DisplayMSG=True)
        #   sys.exit()

   DockerSetup.DisplayClassInfo()
   DockerSetup.DisplayClassActions()
   DockerSetup.Actions()

if __name__ == "__main__":
    main(sys.argv[1:])