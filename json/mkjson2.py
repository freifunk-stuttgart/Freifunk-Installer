#!/usr/bin/python


import os
import json
import sys
import hashlib

def getVendor(s):
	vendor = "unknown"
	if s[0] == "tp":
		return ("TP-LINK",s[2:])
	elif s[0] == "d":
		return ("D-Link",s[2:])
	elif s[0] == "ubiquiti":
		return ("Ubiquiti",s[1:])
	elif s[0] == "buffalo":
		return ("Buffalo",s[1:])
	elif s[0] == "linksys":
		return ("Linksys",s[1:])
	elif s[0] == "gl":
		return("GL",s[1:])
	else:
		return ("Other",s)	

def getModel(vendor, s):
	if vendor == "TP-LINK":
		if s[0].startswith("cpe"):
			return ([s[0].upper()], s[1])
		elif s[0].startswith("tl"):
			if s[2] == "nd":
				model = "-".join(s[0:2]).upper()
				
				return ([model,"%sD"%(model)],s[3])
			else:
				return (["-".join(s[0:2]).upper()],s[2])
	elif vendor == "Buffalo":
		model =  "-".join(s).upper()		
		if model == "WZR-HP-AG300H-WZR-600DHP":
			model =  "WZR-HP-AG300H/WZR-600DHP"
		return ([model],"alle")		
	elif vendor == "D-Link":
		return (["-".join(s[0:2]).upper()],"-".join(s[2:]))		
	elif vendor == "GL":
		return (["-".join(s[0:2]).upper()],"-".join(s[2:]))		
	else:
		return (["-".join(s).upper()],"Alle")		
		
							


#vendors = ["buffalo","tp-link","ubiquiti","d-link"]

directory = "html/gluon/stable/factory"

files = os.listdir(directory)
files.sort()
fs = {}
base = "http://gw01.freifunk-stuttgart.de/gluon/"

for f in files:
        if f.endswith("bin"):
		vendor = "unknown"
		model = "unknown"
		revision = "unknown"
		t = f[0:-4].split("-")[2:]
		print f
		(vendor,next) = getVendor(t)
		#print "%s %s"%(vendor,"-".join(next))
		(models,revision) = getModel(vendor,next)
		for model in models:
			print "%s %s %s"%(vendor,model,revision)	
			if not fs.has_key(vendor):
				fs[vendor] = {}
			if not fs[vendor].has_key(model):
				fs[vendor][model] = {}
			if not fs[vendor][model].has_key(revision):
				fs[vendor][model][revision] = {}	
			if not fs[vendor][model][revision].has_key("factory"):
				fs[vendor][model][revision]["factory"] = {}
			if not fs[vendor][model][revision].has_key("sysupgrade"):
				fs[vendor][model][revision]["sysupgrade"] = {}
			fs[vendor][model][revision]["factory"]["stable"] = base+"stable/factory/"+f
			fs[vendor][model][revision]["factory"]["beta"] = base+"beta/factory/"+f
			fs[vendor][model][revision]["sysupgrade"]["stable"] = ""
			fs[vendor][model][revision]["sysupgrade"]["beta"] = ""
		
	
fp = open("html/gluon/firmwares_s_new.json","wb")
fp.write( json.dumps(fs,sort_keys=True, indent=4, separators=(',', ': ')))
fp.close()
