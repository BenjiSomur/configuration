import random as rnd
import numpy as np
from copy import deepcopy
from omnipmods import mutate


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


def rem_empty(int_part):
    aux_part = list()
    for l in int_part:
        if l == 0:
            continue
        aux_part.append(l)
    return aux_part


def repair_int(int_part, ref):
    aux = list(int_part)
    max_pos = aux.index(max(aux))
    while sum(aux) > ref:
        if aux[max_pos] == 2:
            aux.pop(max_pos)
            pos = rnd.randint(0, len(aux)-1)
            aux[pos] += 1
            max_pos = aux.index(max(aux))
        else:
            aux[max_pos] = aux[max_pos] - 1
    if sum(aux) < ref:
        aux.append(ref-sum(aux))
    if len(aux) <= 2:
        aux.append(aux[max_pos] // 2)
        aux[max_pos] = aux[max_pos] - aux[-1]
    return rem_empty(aux)


def repair_bin(bin_part, ref):
    max_size = len(bin_part)
    max_bits = len("{0:b}".format(ref))
    ref_ints = set(range(1, ref+1))
    div_aux = [bin_part[i:i+max_bits] for i in range(0, max_size, max_bits)]
    int_aux = list(map(lambda x: int(x, 2), div_aux))
    not_included = [x for x in ref_ints if x not in int_aux]
    counted = []
    to_be_replaced = []
    for idx, val in enumerate(int_aux):
        if val > ref or val == 0:
            to_be_replaced.append(idx)
        elif val in counted:
            to_be_replaced.append(idx)
        counted.append(val)
    assert len(to_be_replaced) == len(not_included)
    for idx, val in zip(to_be_replaced, not_included):
        int_aux[idx] = val
    ratio = "0{}b".format(max_bits)
    bin_aux = [format(x, ratio) for x in int_aux]
    return ''.join(bin_aux)


def aux_1px(sub1, sub2):
    p_cros = rnd.randint(1, len(sub1))
    b_aux1 = sub1[:p_cros]
    b_aux2 = sub2[:p_cros]
    b_aux1 = ''.join([b_aux1, sub2[p_cros:]])
    b_aux2 = ''.join([b_aux2, sub1[p_cros:]])
    return [b_aux1, b_aux2]


def onepx(p1, p2):
    pos1 = rnd.randint(0, len(p1)-1)
    pos2 = rnd.randint(0, len(p2)-1)

    np1 = p1[:pos1]
    np2 = p2[:pos2]

    np1.extend(p2[pos2:])
    np2.extend(p1[pos1:])
    np1 = repair_int(np1, sum(p1))
    np2 = repair_int(np2, sum(p1))
    return np1, np2


def mx(parents, ref, pc):
    p1 = parents[0]
    p2 = parents[1]
    max_size = len(p1)
    max_bits = len("{0:b}".format(ref))

    div1 = [p1[i:i+max_bits] for i in range(0, max_size, max_bits)]
    div2 = [p2[i:i+max_bits] for i in range(0, max_size, max_bits)]
    bp1 = list()
    bp2 = list()
    for elem1, elem2 in zip(div1, div2):
        if rnd.uniform(0, 1) < pc:
            aux_b1, aux_b2 = aux_1px(elem1, elem2)
            bp1.append(aux_b1)
            bp2.append(aux_b2)
        else:
            bp1.append(elem1)
            bp2.append(elem2)

    bp1 = ''.join(bp1)
    bp2 = ''.join(bp2)
    try:
        bp1 = repair_bin(bp1, ref)
        bp2 = repair_bin(bp2, ref)
    except AssertionError:
        print([bp1, bp2])

    return bp1, bp2


def crossover(parents, ref, cp):
    p1 = deepcopy(parents[0])
    p2 = deepcopy(parents[1])
    if rnd.uniform(0, 1) >= cp:
        return [p1, p2]

    bp1_aux, bp2_aux = mx([p1[0], p2[0]], ref, cp)
    np1, np2 = onepx(p1[1], p2[1])

    offsp1 = [bp1_aux, np1]
    offsp2 = [bp2_aux, np2]
    return [offsp1, offsp2]


def mutation(chrom, mp, gbls, ref, ftns):
    if rnd.uniform(0, 1) > mp:
        return deepcopy(chrom)
    else:
        return [True, mutate(chrom, gbls, ref, ftns)]
