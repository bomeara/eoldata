sink("/dev/null")
args <- commandArgs(trailingOnly = TRUE)
Sys.setlocale("LC_ALL", "UTF-8")
library(Reol)
print(args[1])
higher.taxonomy<-""
try(higher.taxonomy<-paste(MakeTreeData (DownloadHierarchy(DownloadEOLpages(args[1], to.file=FALSE), to.file=FALSE)), collapse="/"))
sink()
cat(higher.taxonomy)
