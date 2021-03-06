import os
import io
import configparser
import yaml # pip3 install pyyaml
import re

def UpdateINI(DisplayMSG=False,ConfigSegment="DEFAULT",ConfigKey="tag",ConfigValue="",ConfigFile="config.ini"):
    # SETTINGS
    ConfigFile_FullName = os.path.join(PYScriptRoot,ConfigFile)
    ConfigFile_Data = configparser.RawConfigParser(allow_no_value=True)
    ConfigFile_Data.read(ConfigFile_FullName)
    ConfigFile_Data.optionxform=str

    # READ
    ReadElement = ConfigFile_Data.get(ConfigSegment, ConfigKey)

    if DisplayMSG == True:
        print("Read Value [{}]: {}".format(ConfigKey,ReadElement))

    # UPDATE
    ConfigFile_Data.set(ConfigSegment, ConfigKey, ConfigValue)

    if DisplayMSG == True:
        print ("Segment [{}]: {} ({}) Updated".format(ConfigSegment,ConfigKey,ConfigValue))

    # WRITE
    with open(ConfigFile_FullName, 'w') as configfile:
        ConfigFile_Data.write(configfile)

def UpdateYAML(DisplayMSG=False,ConfigSegment="DEFAULT",ConfigKey="next-version",ConfigValue="",ConfigFile="config.yaml"):
    # SETTINGS
    ConfigFile_FullName = os.path.join(PYScriptRoot,ConfigFile)
    
    # READ
    with open(ConfigFile_FullName, 'r') as file:
        ConfigFile_Data = yaml.load(file, Loader=yaml.FullLoader)
    
    if DisplayMSG == True:
        for key, val in ConfigFile_Data.items():
            print(key, ":", val)

    # UPDATE
    ConfigFile_Data[ConfigKey] = ConfigValue

    if DisplayMSG == True:
        for key, val in ConfigFile_Data.items():
            print(key, ":", val)

    # WRITE
    with open(ConfigFile_FullName, 'w') as file:
        ConfigFile_Data = yaml.dump(ConfigFile_Data, file)

def UpdatePHP(DisplayMSG=False,ConfigSegment="DEFAULT",ConfigKey="version",ConfigValue="",ConfigFile="config.php"):
    # SETTINGS
    ConfigFile_FullName = os.path.join(PYScriptRoot,ConfigFile)

    # READ
    with open(ConfigFile_FullName, 'r') as file:
        ConfigFile_Data = file.read()
    
    if DisplayMSG == True:
        print(ConfigFile_Data)

    # UPDATE
    ConfigFile_Data_Replace = re.compile('\$'+ ConfigKey + ' =.*;')

    if DisplayMSG == True:
        print(ConfigFile_Data_Replace)

    # WRITE
    with open(ConfigFile_FullName, 'r+') as file:
        data = ConfigFile_Data_Replace.sub('$version = \"' + ConfigValue + '\";', file.read())
        file.seek(0) # Places the text "Input" in the file at the beginning of the file
        file.write(data)
        file.truncate() 

    #This will cause all trailing data to be flushed.
    # reason for doing this is because your default value of `$limit_value` might
    # make your total content written back to the file shorter of that was writter before.
    # there for there might be trailing data we need to truncate away.    

DisplayMSG = False
SetVersion = "2.9.3"

PYScriptRoot = os.path.abspath(os.path.dirname(__file__))

VersionFile_01 = "DockerSetup.config"
VersionFile_02 = "../GitVersion.yml"
VersionFile_03 = "../settings/PMPInfo.php"

UpdateINI(DisplayMSG=DisplayMSG,ConfigFile=VersionFile_01,ConfigValue=SetVersion)
UpdateYAML(DisplayMSG=DisplayMSG,ConfigFile=VersionFile_02,ConfigValue=SetVersion)
UpdatePHP(DisplayMSG=DisplayMSG,ConfigFile=VersionFile_03,ConfigValue=SetVersion)