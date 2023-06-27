import random as rnd
import numpy as np
from copy import deepcopy, copy
from omnipmods import mutate_indiv
from decoder import encode


def init_population(pop_size, nodes):
    max_bits = len("{0:b}".format(nodes))
    ratio = "0{}b".format(max_bits)
    pop = []
    while len(pop) < pop_size:
        indiv = list()
        aux = [format(x, ratio) for x in range(1, nodes+1)]
        rnd.shuffle(aux)
        indiv.append(''.join(aux))
        no_clus = rnd.randint(3, nodes // 2)
        _ref = [0] * nodes
        aux2 = [len(x) for x in np.array_split(_ref, no_clus)]
        rnd.shuffle(aux2)
        indiv.append(aux2)
        pop.append(indiv)
    return pop
