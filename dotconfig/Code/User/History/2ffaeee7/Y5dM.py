from mdgparser import get_nodes, create_table, get_globals
from initializer import *
from operators import init_population, tournament, crossover, mutation, dominance_sort
from fitness import Fitness
from decoder import decode
from dotgrapher import create_graph
import sys
import os
from copy import deepcopy
from psutil import virtual_memory

total_memory = virtual_memory().available
cache_percent = 0.03
cache_size = int(total_memory * cache_percent)

data = None
it_no = sys.argv[1]
filename = sys.argv[2]
_cop = sys.argv[3]
_intx = sys.argv[4]
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

no_gen = 0
_kwargs = {'filename': filename,
           'it_no': it_no,
           'type': _cop,
           'best': best[0],
           'fitness': best[1],
           'nodes': len(ref),
           'gen': no_gen,
           'intx': _intx
           }

while no_gen < gens:
    parents = list(tournament(_pop, pop_size))
    offsp = list()
    for i in range(0, len(parents), 2):
        gen_chld = crossover(
            [_pop[parents[i]][0], _pop[parents[i+1]][0]], len(nodes), cp, _cop, _intx)
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
    _kwargs = {'filename': filename,
               'it_no': it_no,
               'type': _cop,
               'best': best[0],
               'fitness': best[1],
               'gen': no_gen,
               'nodes': len(ref),
               'intx': _intx}
    write_gen(_kwargs)
    write_csv(_kwargs)

# _pop_aux = list()
# for sol in _pop:
#     enhanced_indiv = rep_solut(sol, glbls, ref, fitness)
#     _pop_aux.append(enhanced_indiv)
# _pop = dominance_sort(_pop_aux)
# best = _pop[0]
# print("Enhanced {}: ".format(no_gen + 1), best)
# _kwargs = {'filename': filename,
#            'it_no': it_no,
#            'type': _cop,
#            'best': best[0],
#            'fitness': best[1],
#            'gen': 'enhanced',
#            'nodes': len(ref),
#            'intx': _intx}
# write_gen(_kwargs)
# write_csv(_kwargs)
mqs = []
noclusts = []
maxclusts = []
minclusts = []
for p in _pop:
    mqs.append(p[1][1])
    noclusts.append(len(p[0][1]))
    maxclusts.append(max(p[0][1]))
    minclusts.append(min(p[0][1]))
results = pd.DataFrame(list(zip(mqs, noclusts, maxclusts, minclusts)), columns=[
    'mq', 'No. Clus', 'Max clus', 'Min clus'])
# get_clus.cache_clear()
# turbomq.cache_clear()
try:
    os.makedirs(f'./{filename}/{_cop}/{_intx}/{it_no}/final_population')
except IOError:
    raise

for idx, p in enumerate(_pop):
    _kwargs = {'filename': filename,
               'type': _cop,
               'it_no': it_no,
               'pop_ord': idx,
               'chrom': p[0],
               'nodes': nodes,
               'raw_data': data,
               'intx': _intx
               }
    create_graph(_kwargs)

_path = f'./{filename}/{_cop}/{_intx}'
if not os.path.exists('{}/bests.csv'.format(_path)):
    with open('{}/bests.csv'.format(_path), 'w') as f:
        f.write('It No., Best MQ, No clusters, max clus, min clus\n')
with open('{}/bests.csv'.format(_path), 'a') as f:
    f.write('{},{},{},{},{}\n'.format(it_no,
                                      best[1][1],
                                      len(best[0][1]),
                                      max(best[0][1]),
                                      min(best[0][1])))
results.to_csv('{}/{}/pop_results.csv'.format(_path, it_no))
with open('{}/{}/final_population.txt'.format(_path, it_no), 'w') as f:
    for idx, p in enumerate(_pop):
        sol = decode(p[0], len(nodes))
        f.write('{}: {}\n'.format(idx, sol))
