rm(list=ls())
Sys.setlocale("LC_ALL", "UTF-8") 
library(Reol)
library(foreach)
library(doMC)
registerDoMC(16)

#batch file
#MyDir <- system("ls /Users/bomeara/Documents/MyDocuments/Active/eolPages", intern=T) [41:50]
MyDir <- system("ls /Library/WebServer/Sites/eoldata.org/eolPages", intern=T)
DoDir <- function(MyDirName) {
  setwd(paste("/Library/WebServer/Sites/eoldata.org/eolPages/", MyDirName, sep=""))
  MyEOLs <- system(paste("ls eol*", sep=""), intern=T)
  isThereATable  <- system("ls table4*", intern=T)
  system(paste("rm", isThereATable))
  start.time <- proc.time()[[3]]
  results <- try(CollectDataforWeb(MyEOLs[1], do.higher.taxonomy=TRUE), silent=TRUE)
  write.table(results, file=paste("table4_", MyDirName, ".txt", sep=""), col.names=F, row.names=F, sep="\t")
  for(i in 1:length(MyEOLs)) {
  	results <- NA
    try(results  <- CollectDataforWeb(MyEOLs[i], do.higher.taxonomy=TRUE), silent=TRUE)
	if (!is.na(results)) {
    	write.table(results, file=paste("table4_", MyDirName, ".txt", sep=""), append=T, col.names=F, row.names=F, sep="\t")
    }
  }
  end.time <- proc.time()[[3]] - start.time
  cat(MyDirName, file="TABLE4.done.txt")
  setwd("/Library/WebServer/Sites/eoldata.org/eolPages")
}



foreach(MyDirName=MyDir) %dopar% {
	DoDir(MyDirName)
}







