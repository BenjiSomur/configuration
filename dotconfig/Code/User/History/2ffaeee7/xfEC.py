from mdgparser import get_nodes, create_table, get_globals
from initializer import *
from operators import init_population, tournament, crossover, mutation, dominance_sort
from fitness import Fitness
from dotgrapher import create_graph
import sys
import os
from copy import deepcopy
from psutil import virtual_memory

total_memory = virtual_memory().available
cache_percent = 0.03
cache_size = int(total_memory * cache_percent)

data = None
filename = sys.argv[1]

if not os.path.exists("./{}".format(filename)):
    try:
        os.makedirs("./{}".format(filename))
    except IOError:
        raise

with open('../mdgs/{}.mdg'.format(filename), 'r') as f:
    data = f.readlines()

nodes = get_nodes(data)
ref = create_table(data)

pop_size = get_pop_size(nodes)
cp = get_cp(nodes)
mp = get_mp(nodes)
_theta = get_theta(nodes)

gens = get_no_gen(nodes)

fitness = Fitness(ref, _theta, cache_size)
glbls = get_globals(ref)
raw_pop = init_population(pop_size, len(nodes))
_pop = []
for chrom in raw_pop:
    ft = fitness(chrom)
    _pop.append([chrom, ft])
del raw_pop

_pop = dominance_sort(_pop)
best = list(_pop[0])
print(best)
no_gen = 0

while no_gen < gens:
    parents = list(tournament(_pop, pop_size))
    offsp = list()
    for i in range(0, len(parents), 2):
        gen_chld = crossover(
            [_pop[parents[i]][0], _pop[parents[i+1]][0]], len(nodes), cp)
        chld1 = mutation(gen_chld[0], mp, glbls, ref, fitness)
        chld2 = mutation(gen_chld[1], mp, glbls, ref, fitness)
        offsp += [chld1, chld2]
    aux = list()
    for chrom in offsp:
        ft = fitness(chrom)
        aux.append([chrom, ft])

    _aux = dominance_sort(aux)
    _aux.pop(-1)
    for auxid in range(pop_size - 1):
        if best[1][1] > _aux[auxid][1][1]:
            _aux.insert(auxid, best)
            break
    if len(_aux) < pop_size:
        _aux.append(deepcopy(best))
    del _pop
    _pop = deepcopy(_aux)
    del best
    del _aux
    best = _pop[0]
    print("{}: ".format(no_gen + 1), best)
    no_gen += 1

if not os.path.exists("./{}/final_population".format(filename)):
    try:
        os.makedirs("./{}/final_population".format(filename))
    except IOError:
        raise

for idx, p in enumerate(_pop):
    _kwargs = {'filename': filename,
               'pop_ord': idx,
               'chrom': p[0],
               'nodes': nodes,
               'raw_data': data,
               }
    create_graph(_kwargs)
