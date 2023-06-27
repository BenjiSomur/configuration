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
    max_size = len(   chrom[0])
    max_bits = len("{0:b}".format(nodes))
    div_aux = [chrom[0][i:i+max_bits] for i in range(0, max_size,max_bits)]
    int_aux = [int(x, 2) for x in div_aux]
    decoded = []
    for size in chrom[1]:
        aux = [int_aux.pop(0) for _ in range(size)]
        decoded.append(aux)
    return decoded