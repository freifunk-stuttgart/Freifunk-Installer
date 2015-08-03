#!/usr/bin/python


import os
import json
import sys
import hashlib

vendors = ["buffalo","tp-link","ubiquiti","d-link"]

directory = "html/gluon/stable/factory"

files = os.listdir(directory)
files.sort()
ff = []
fs = {}
base = "http://gw01.freifunk-stuttgart.de/gluon/"

for f in files:
        if f.endswith("bin"):
		for vendor in vendors:
			if vendor in f:
				model = f.split(vendor+"-")[1].replace(".bin","")
				if model[-2] == "v":
					revision =  model[-2:]
					model = model[:-3]
				else:
					revision = "alle"	
				if vendor == "tp-link" and model.startswith("tl-"):
					model = model[3:]			
				if model.find("n-nd") != -1:
					models = []
					for s in ["n","nd"]:
						models.append(model[:-5]+s)
				else:
					models = [model]
				for model in models:
					vendor = vendor.upper()
					model = model.upper()
					revision = revision.upper()
					print "Vendor %s"%(vendor)
					print "Model %s"%(model)
					print "Revision: %s"%(revision)
					print "File: %s"%(f)
					print "-----------------"	
					fw = {}
					fw["vendor"] = vendor
					fw["model"] = model
					fw["revision"] = revision
					fw["factory_stable"] = base+"stable/factory/"+f
					fw["factory_beta"] = base+"beta/factory/"+f
					fw["sysupgrade_stable"] = ""
					fw["sysupgrade_beta"] = ""
					ff.append(fw)
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

					

				
fp = open("html/gluon/firmwares_f.json","wb")
fp.write( json.dumps(ff,sort_keys=True, indent=4, separators=(',', ': ')))
fp.close()
fp = open("html/gluon/firmwares_s.json","wb")
fp.write( json.dumps(fs,sort_keys=True, indent=4, separators=(',', ': ')))
fp.close()
