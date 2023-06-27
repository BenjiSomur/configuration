from itertools import chain

def encode(chrom, nodes):
    max_bits = len("{0:b}".format(nodes))
    ratio = "0{}b".format(max_bits)
    indiv = list()
    intpart = [len(x) for x in chrom]
    binflat = list(chain(*chrom))
    aux = [format(x, ratio) for x in binflat]
    indiv.append(''.join(aux))
    indiv.append(intpart)
    return indiv

def decode(chrom, nodes):
    