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


def doms(p, q):
    mq_p = p[1][1]
    mq_q = q[1][1]
    ftp = p[1][0]
    ftq = q[1][0]

    if mq_p >= mq_q and ftp >= ftq:
        if mq_p > mq_q or ftp > ftq:
            return True
        else:
            return False
    else:
        return False


def dominance_sort(pop):
    aux_pop = pop[:]
    s_pop = []
    while len(aux_pop) != 0:
        p = aux_pop[0]
        s_aux = [p]
        for q in [x for x in aux_pop if x not in s_aux]:
            if len(s_aux) == 1:
                p = s_aux[0]
                if doms(q, p):
                    p = q
                    s_aux[0] = q
                elif not doms(p, q) and not doms(q, p):
                    s_aux.append(q)
            else:
                n = 0
                ss_aux = s_aux[:]
                for j in range(len(ss_aux)):
                    f = ss_aux[j]
                    if doms(q, f):
                        if q not in s_aux:
                            s_aux[j] = q
                        else:
                            s_aux.remove(f)
                    elif not doms(f, q) and not doms(q, f):
                        n += 1
                if n == len(s_aux):
                    s_aux.append(q)
        s_pop += s_aux
        for f in s_aux:
            aux_pop.remove(f)
    return s_pop


def tournament(pop, pop_size):
    for _ in range(pop_size):
        opts = rnd.sample(list(range(pop_size)), 2)
        if pop[opts[0]][1][0] > pop[opts[1]][1][0]:
            yield opts[0]
        else:
            yield opts[1]
