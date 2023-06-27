from decoder import decode, encode
from math import ceil
from copy import deepcopy
from mdgparser import transpose_mat
import numpy as np


def related_to(ref, chrom, modn):
    rels = list()
    for no_cl, clus in enumerate(chrom):
        if modn in clus:
            continue
        for modaux in clus:
            if no_cl in rels:
                break
            if ref[modn - 1][modaux-1] > 0 or ref[modaux-1][modn - 1] > 0:
                rels.append(no_cl)
    return rels


def detomns(glbls, chrom, ref):
    for idx in glbls:
        refs = related_to(ref, chrom, idx)
        if len(refs) >= 2:
            yield idx


def from_clus(omnid, ref, chrom):
    depends = [0]*len(chrom)
    auxref = transpose_mat(ref)
    nodeps = sum(ref[omnid - 1]) + sum(auxref[omnid - 1])
    for idx, clus in enumerate(chrom):
        for modaux in clus:
            if ref[omnid - 1][modaux-1] > 0 or ref[modaux-1][omnid - 1] > 0:
                depends[idx] += ref[omnid - 1][modaux-1]
                depends[idx] += ref[modaux - 1][omnid - 1]
    try:
        auxsums = [*map(lambda x: x / nodeps, depends)]
    except ZeroDivisionError:
        print(np.array(ref))
        print(*depends)
        print(omnid)
        print(chrom)
        raise
    return [(idx, score) for idx, score in enumerate(auxsums)]


def extract_omnis(omnis, chrom):
    _aux = deepcopy(chrom)
    origs = []
    for nmod in omnis:
        for idx in range(len(_aux)):
            if nmod in _aux[idx]:
                origs.append((nmod, idx))
                _aux[idx].pop(_aux[idx].index(nmod))
                break
    aux2 = remempt(_aux)
    return (aux2, origs)


def remempt(chrom):
    aux = list()
    for clus in chrom:
        if len(clus) == 0:
            continue
        aux.append(deepcopy(clus))
    return aux


def get_highest(dscores, gamma):
    aux = list(dscores)
    aux.sort(key=lambda x: x[1])
    return aux[len(aux) - gamma:]


def get_omnilocals(ref, chrom):
    for clus in chrom:
        for nomod in clus:
            omnirefs = related_to(ref, chrom, nomod)
            if len(omnirefs) > 2:
                yield nomod


def detomnlcls(ref, omnlocals):
    aux_ref = transpose_mat(ref)
    locls = list()
    for idx in omnlocals:
        locls.append((idx, sum(ref[idx - 1]) + sum(aux_ref[idx - 1])))
    aux_locls = sorted(locls, key=lambda x: x[1])
    return aux_locls


def extendomns(omns, lcls):
    aux = set(omns)
    for (auxid, _) in lcls:
        aux.add(auxid)
    return list(aux)
