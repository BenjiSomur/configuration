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


def stoch_tourn(pop, pop_size, prt, smpl):
    for _ in range(pop_size):
        opts = rnd.sample(list(range(pop_size)), smpl)
        opts.sort(key=lambda x: pop[x][1][0])
        if rnd.uniform(0, 1) <= prt:
            yield opts[-1]
        else:
            _id = rnd.randrange(0, len(opts))
            yield opts[_id]


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


def get_differ(c1, c2):
    bdiffer = []
    for indx, (val1, val2) in enumerate(zip(c1, c2)):
        if val1 == '1' and val2 == '0':
            bdiffer.append(indx)
    return bdiffer


def px1_i(p1, p2):
    pos1 = rnd.randint(0, len(p1)-1)
    pos2 = rnd.randint(0, len(p2)-1)

    np1 = p1[:pos1]
    np2 = p2[:pos2]

    np1.extend(p2[pos2:])
    np2.extend(p1[pos1:])
    np1 = repair_int(np1, sum(p1))
    np2 = repair_int(np2, sum(p1))
    return np1, np2


def exchange_i(p1, p2):
    np1 = deepcopy(p2)
    np2 = deepcopy(p1)
    return np1, np2


def inverse_i(p1, p2):
    pos1 = rnd.randint(1, len(p1)-1)
    pos2 = rnd.randint(1, len(p2)-1)
    np1 = p1[:pos1]
    np2 = p2[:pos2]
    np1.reverse()
    np2.reverse()
    np1.extend(p1[pos1:])
    np2.extend(p2[pos2:])
    return np2, np1


def cpx(parents, ref, int_type):
    intx = '{}_i'.format(int_type)
    p1 = parents[0]
    p2 = parents[1]
    bp1 = list(p1[0])
    bp2 = list(p2[0])
    wbdu = get_differ(p1[0], p2[0])
    wbdd = get_differ(p2[0], p1[0])
    assert len(wbdd) == len(wbdu)
    for id1, id2 in zip(wbdu, wbdd):
        if rnd.uniform(0, 1) > 0.5:
            bp1[id1] = '0'
            bp2[id1] = '1'
            bp1[id2] = '1'
            bp2[id2] = '0'
    bp1 = ''.join(bp1)
    bp2 = ''.join(bp2)

    bp1 = repair_bin(bp1, ref)
    bp2 = repair_bin(bp2, ref)

    np1, np2 = eval('{}({},{})'.format(intx, p1[1], p2[1]))

    offsp1 = [bp1, np1]
    offsp2 = [bp2, np2]

    return [offsp1, offsp2]


def onepx(parents, ref, int_type):
    intx = '{}_i'.format(int_type)
    p1 = parents[0]
    p2 = parents[1]

    bp_pos = rnd.randint(1, len(p1[0])-1)

    bp1 = p1[0][:bp_pos]
    bp2 = p2[0][:bp_pos]

    bp1 = ''.join([bp1, p2[0][bp_pos:]])
    bp2 = ''.join([bp2, p1[0][bp_pos:]])

    bp1 = repair_bin(bp1, ref)
    bp2 = repair_bin(bp2, ref)

    np1, np2 = eval('{}({},{})'.format(intx, p1[1], p2[1]))

    offsp1 = [bp1, np1]
    offsp2 = [bp2, np2]

    return [offsp1, offsp2]


def uniformx(parents, ref, int_type):
    intx = '{}_i'.format(int_type)
    p1 = parents[0]
    p2 = parents[1]

    bp1 = list()
    bp2 = list()
    for val1, val2 in zip(list(p1[0]), list(p2[0])):
        if rnd.uniform(0, 1) > 0.5:
            bp1.append(val1)
            bp2.append(val2)
        else:
            bp1.append(val2)
            bp2.append(val1)

    bp1 = ''.join(bp1)
    bp2 = ''.join(bp2)

    bp1 = repair_bin(bp1, ref)
    bp2 = repair_bin(bp2, ref)

    np1, np2 = eval('{}({},{})'.format(intx, p1[1], p2[1]))

    offsp1 = [bp1, np1]
    offsp2 = [bp2, np2]

    return [offsp1, offsp2]


def rrx(parents, ref, int_type):
    intx = '{}_i'.format(int_type)
    p1 = parents[0]
    p2 = parents[1]
    sim_vec = list()
    for val1, val2 in zip(list(p1[0]), list(p2[0])):
        if val1 == val2:
            if val1 == '1':
                sim_vec.append('1')
            else:
                sim_vec.append('0')
        else:
            sim_vec.append('none')

    bp1 = list()
    bp2 = list()

    for val in sim_vec:
        if val != 'none':
            bp1.append(val)
            bp2.append(val)
        else:
            if rnd.uniform(0, 1) >= 0.5:
                bp1.append('0')
            else:
                bp1.append('1')
            if rnd.uniform(0, 1) >= 0.5:
                bp2.append('0')
            else:
                bp2.append('1')
    bp1 = ''.join(bp1)
    bp2 = ''.join(bp2)

    bp1 = repair_bin(bp1, ref)
    bp2 = repair_bin(bp2, ref)

    np1, np2 = eval('{}({},{})'.format(intx, p1[1], p2[1]))

    offsp1 = [bp1, np1]
    offsp2 = [bp2, np2]

    return [offsp1, offsp2]


def aux_1px(sub1, sub2):
    p_cros = rnd.randint(1, len(sub1))
    b_aux1 = sub1[:p_cros]
    b_aux2 = sub2[:p_cros]
    b_aux1 = ''.join([b_aux1, sub2[p_cros:]])
    b_aux2 = ''.join([b_aux2, sub1[p_cros:]])
    return [b_aux1, b_aux2]


def mx(parents, ref, int_type, pc):
    intx = '{}_i'.format(int_type)
    p1 = parents[0]
    p2 = parents[1]
    max_size = len(p1[0])
    max_bits = len("{0:b}".format(ref))
    ref_ints = set(range(1, ref+1))
    div1 = [p1[0][i:i+max_bits] for i in range(0, max_size, max_bits)]
    div2 = [p2[0][i:i+max_bits] for i in range(0, max_size, max_bits)]
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

    bp1 = repair_bin(bp1, ref)
    bp2 = repair_bin(bp2, ref)

    np1, np2 = eval('{}({},{})'.format(intx, p1[1], p2[1]))

    offsp1 = [bp1, np1]
    offsp2 = [bp2, np2]

    return [offsp1, offsp2]


def crossover(parents, ref, cp, _cop, int_type):
    assert _cop in ['onepx', 'cpx', 'uniformx', 'rrx', 'mx']
    if rnd.uniform(0, 1) >= cp:
        p1 = deepcopy(parents[0])
        p2 = deepcopy(parents[1])
        return [p1, p2]

    offsp = None
    if _cop == 'onepx':
        offsp = onepx(parents, ref, int_type)
    elif _cop == 'cpx':
        offsp = cpx(parents, ref, int_type)
    elif _cop == 'uniformx':
        offsp = uniformx(parents, ref, int_type)
    elif _cop == 'rrx':
        offsp = rrx(parents, ref, int_type)
    elif _cop == 'mx':
        offsp = mx(parents, ref, int_type, cp)

    return offsp


def mutation(chrom, mp, glbls, ref, ftns):
    if rnd.uniform(0, 1) > mp:
        return deepcopy(chrom)
    else:
        return mutate_indiv(chrom, glbls, ref, ftns)


# def getnonbins(intpart):
#     positions = []
#     for x, val in enumerate(intpart):
#         if val > 2:
#             positions.append(x)
#     return positions


# def mutation(chrom, mp):
#     if rnd.uniform(0, 1) > mp:
#         return deepcopy(chrom)
#     nonbins = getnonbins(chrom[1])
#     if len(nonbins) < 2:
#         return deepcopy(chrom)
#     pos1, pos2 = rnd.sample(nonbins, 2)
#     b_aux = chrom[0][:]
#     a_aux = [x for x in chrom[1]]
#     a_aux[pos1] -= 1
#     a_aux[pos2] += 1
#     return [b_aux, a_aux]


# def mutation(chrom, mp):
#     if rnd.uniform(0, 1) > mp:
#         return list(chrom)
#     pos1, pos2 = rnd.sample(list(range(len(chrom[1]))), 2)
#     b_aux = chrom[0][:]
#     a = chrom[1][pos1]
#     b = chrom[1][pos2]
#     aux = [x for x in chrom[1]]
#     aux[pos1] = b
#     aux[pos2] = a
#     return [b_aux, aux]
